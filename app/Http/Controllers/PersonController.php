<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Person;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->query('order', 'asc');
        $currentPage = $request->query('page', 1); // Capture current page number

        $user = auth()->user();

        $people = $user->people()->orderBy('firstname', $order)
                        ->orderBy('lastname', $order)
                        ->paginate(10, ['*'], 'page', $currentPage);

        return view('person.index')->with(['people' => $people, 'order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $businesses = auth()->user()->businesses()->orderBy('business_name')->get();
        $tags = auth()->user()->tags()->get();
        return view('person.create')->with(['businesses' => $businesses, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonRequest $request)
    {
        $user = auth()->user();

        $person = new Person($request->validated());
        $person->user()->associate($user);
        $person->save();


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $custom_name = time() . '_' . $person->firstname . '_' . $person->lastname . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $custom_name);
            $person->image = $path;
            $person->save();
        }

        $person->tags()->sync($request->tags);

        return redirect(route('person.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        $this->authorize('view', $person);

        return view('person.detail')->with('person', $person);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        $this->authorize('view', $person);

        $businesses = auth()->user()->businesses()->orderBy('business_name')->get();
        $tags = auth()->user()->tags()->get();
        return view('person.edit')->with(['person' => $person, 'businesses' => $businesses, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonRequest $request, Person $person)
    {
        $this->authorize('update', $person);
        $person->update($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images');
            $person->image = $path;
            $person->save();
        }

        $person->tags()->sync($request->tags);

        // return redirect(route('person.index'));
        return view('person.detail')->with('person', $person);

    }

    /**
     * Search person
     */
    public function search(Request $request)
    {
        // Get the search value from teh request
        $search = $request->input('search');

        // Combine search in the firstname and lastname columns from the people table
        $searchTerms = explode(' ', $search);

        // $people = Person::query();
        $people = auth()->user()->people();

        foreach ($searchTerms as $term) {
            $people->where(function ($query) use ($term) {
                $query->where('firstname', 'LIKE', "%{$term}%")
                    ->orWhere('lastname', 'LIKE', "%{$term}%");
            });
        }

        $people = $people->get();

        return view('person.search')->with(['people' => $people, 'search' => $search]);
    }

    public function getByTag(Request $request, $tag)
    {
        $tagModel = Tag::where('tag_name', $tag)->firstOrFail();
        $people = $tagModel->people()->where('user_id', auth()->id())->paginate(4);
        $order = $request->query('order', 'asc');

        return view('person.index')->with(['people' => $people, 'order' => $order]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $this->authorize('delete', $person);
        $person->tasks()->delete();
        $person->delete();

        return redirect(route('person.index'));
    }
}
