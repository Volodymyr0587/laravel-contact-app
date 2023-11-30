<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteTag;
use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('note.index')->with('notes', Note::orderBy('created_at', 'desc')->paginate(10));
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
        $note = Note::create($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $custom_name = time() . '_' . preg_replace('/\s+/', '_', $note->title) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images/notes', $custom_name);
            $note->image = $path;
            $note->save();
        }

        $tagNames = explode(" ", preg_replace('/\s+/', ' ', trim($request->tags)));

        $this->syncTags($note, $tagNames);

        $relatedNotes = Note::whereHas('tags', function ($query) use ($note) {
            $query->whereIn('note_tag_id', $note->tags->pluck('id'));
        })->where('id', '!=', $note->id)->get();

        foreach ($tagNames as $tagName) {
            // Add links to related articles
            foreach ($relatedNotes as $relatedNote) {
                // Use regular expressions with a callback function for replacement
                $relatedNote->body = preg_replace_callback(
                    "/\b$tagName\b/i",
                    function ($matches) use ($note, $tagName) {
                        // Create a link in the text
                        return "<a href='" . route('note.show', $note->id) . "' class='text-blue-500 underline font-bold'>$matches[0]</a>";
                    },
                    $relatedNote->body
                );

                $relatedNote->save();
            }
        }
        return redirect(route('note.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // Get related notes with the same tags
        $relatedNotes = Note::whereHas('tags', function ($query) use ($note) {
            $query->whereIn('note_tag_id', $note->tags->pluck('id'));
        })->where('id', '!=', $note->id)->get();

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
        return view('note.edit')->with(['note' => $note, 'tags' => NoteTag::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        $note->update($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $custom_name = time() . '_' . preg_replace('/\s+/', '_', $note->title) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images/notes', $custom_name);
            $note->image = $path;
            $note->save();
        }

        $tagNames = explode(" ", preg_replace('/\s+/', ' ', trim($request->tags)));

        $tags_id = [];

        foreach ($tagNames as $tagName) {
            $tag = NoteTag::firstOrCreate(['tag_name' => $tagName]);
            $tags_id[] = $tag->id;
        }

        $note->tags()->sync($tags_id);

        return redirect(route('note.index'));
    }

    /**
     * Search notes
     */
    public function search(Request $request)
    {
        // Get the search value from teh request
        $search = $request->input('search');

        // Search in the firstname and lastname columns from the notes table
        $notes = Note::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('body', 'LIKE', "%{$search}%")
            ->paginate(5);

        return view('note.search')->with(['notes' => $notes, 'search' => $search]);
    }

    public function getByTag($tag)
    {
        $tagModel = NoteTag::where('tag_name', $tag)->firstOrFail();
        $notes = $tagModel->notes()->paginate(4);

        return view('note.index')->with(['notes' => $notes]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
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

        return redirect(route('note.index'));
    }
}
