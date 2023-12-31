<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteTag;
use Illuminate\Http\Request;
use App\Services\NoteLinkService;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{
    protected $noteLinkService;

    public function __construct(NoteLinkService $noteLinkService)
    {
        $this->noteLinkService = $noteLinkService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $notes = $user->notes()->orderByDesc('is_active')->orderByDesc('created_at')->paginate(10);

        return view('note.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create')->with('note_tags', NoteTag::all());
    }

    /**
     * Tag handling method
     */
    private function syncTags(Note $note, $tagNames)
    {
        $tags_id = [];

        foreach ($tagNames as $tagName) {
            $tag = NoteTag::firstOrCreate(['tag_name' => $tagName]);
            $tags_id[] = $tag->id;
        }

        $note->tags()->sync($tags_id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        $user = auth()->user();

        $note = new Note($request->validated());
        $note->user()->associate($user);
        $note->save();

        $this->saveImage($note, $request);

        $tagNames = explode(" ", preg_replace('/\s+/', ' ', trim($request->tags)));

        if (!empty(array_filter($tagNames, 'strlen'))) {
            $this->syncTags($note, $tagNames);
            // Call the method to add links to related articles
            $this->noteLinkService->addLinksToRelatedNotes($note, $tagNames);
        }
        return redirect(route('note.index'))->with('store', 'Note created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $this->authorize('view', $note);
        // Get related notes with the same tags
        $relatedNotes = Note::whereHas('tags', function ($query) use ($note) {
            $query->whereIn('note_tag_id', $note->tags->pluck('id'));
        })->where([
                    ['id', '!=', $note->id],
                    ['user_id', '=', $note->user_id],
                ])->get();

        return view('note.detail')->with([
            'note' => $note,
            'relatedNotes' => $relatedNotes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $this->authorize('view', $note);

        return view('note.edit')->with(['note' => $note, 'tags' => NoteTag::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        $this->authorize('update', $note);
        // $note->is_active = $request->has('is_active'); // Set based on checkbox status
        $note->update($request->validated());

        $this->saveImage($note, $request);

        $tagNames = explode(" ", preg_replace('/\s+/', ' ', trim($request->tags)));

        // Remove existing tags
        $note->tags()->detach();

        if (!empty(array_filter($tagNames, 'strlen'))) {
            $this->syncTags($note, $tagNames);
            // Call the method to add links to related articles
            $this->noteLinkService->addLinksToRelatedNotes($note, $tagNames);
        }

        // $note->save();

        return redirect(route('note.index'))->with('store', 'Note updated successfully');
    }

    /**
     * Save image logic
     */
    protected function saveImage(Note $note, NoteRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $custom_name = time() . '_' . preg_replace('/\s+/', '_', $note->title) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images/notes', $custom_name);
            $note->image = $path;
            $note->save();
        }
    }

    /**
     * Search notes
     */
    public function search(Request $request)
    {
        // Get the search value from teh request
        $search = $request->input('search');

        // Combine search in the title and body columns from the notes table
        $searchTerms = explode(' ', $search);

        // Get current user notes
        $notes = auth()->user()->notes();

        foreach ($searchTerms as $term) {
            $notes->where(function ($query) use ($term) {
                $query->where('title', 'LIKE', "%{$term}%")
                ->orWhere('body', 'LIKE', "%{$term}%");
            });
        }

        $notes = $notes->paginate(5);

        return view('note.search')->with(['notes' => $notes, 'search' => $search]);
    }

    public function getByTag($tag)
    {
        $tagModel = NoteTag::where('tag_name', $tag)->firstOrFail();
        $notes = $tagModel->notes()->where('user_id', auth()->id())->paginate(4);

        return view('note.index')->with(['notes' => $notes]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        // Find and remove links pointing to the deleted note
        $this->noteLinkService->removeLinksToDeletedNote($note);

        $tagsToDelete = $note->tags;

        // Detach the tags from the note
        $note->tags()->detach();

        // Check if any of the detached tags are not associated with any other notes
        foreach ($tagsToDelete as $tag) {
            if ($tag->notes()->count() === 0) {
                // If the tag is not associated with any other notes, delete it
                $tag->delete();
            }
        }
        // Delete the note
        $note->delete();

        return redirect(route('note.index'))->with('destroy', 'Note has been deleted successfully');
    }

}
