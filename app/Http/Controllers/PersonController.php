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

        // $people = Person::all();
        // return view('person.index', compact('people'));

        //? Eager Loading:
        //? 1st variant
        // return view('person.index')->with('people', Person::with('business')->get());
        //? 2nd variant (add `protected $with = ['business'];` to `Person` model)
        // $people = Person::orderBy('firstname', $order)
        //                 ->orderBy('lastname', $order)
        //                 ->paginate(10);
        $people = Person::orderBy('firstname', $order)
                        ->orderBy('lastname', $order)
                        ->paginate(10, ['*'], 'page', $currentPage);

        return view('person.index')->with(['people' => $people, 'order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('person.create')->with(['businesses' => Business::orderBy('business_name')->get(), 'tags' => Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonRequest $request)
    {
        $person = Person::create($request->validated());

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
        return view('person.detail')->with('person', $person);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        return view('person.edit')->with(['person' => $person, 'businesses' => Business::all(), 'tags' => Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonRequest $request, Person $person)
    {
        $person->update($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images');
            $person->image = $path;
            $person->save();
        }

        $person->tags()->sync($request->tags);

        return redirect(route('person.index'));
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

        $people = Person::query();

        foreach ($searchTerms as $term) {
            $people->where(function ($query) use ($term) {
                $query->where('firstname', 'LIKE', "%{$term}%")
                    ->orWhere('lastname', 'LIKE', "%{$term}%");
            });
        }

        $people = $people->get();

        return view('person.search')->with(['people' => $people, 'search' => $search]);
    }

    public function getByTag($tag)
    {
        $tagModel = Tag::where('tag_name', $tag)->firstOrFail();
        $people = $tagModel->people()->paginate(4);

        // return view('person.index', ['people' => $people]);
        // $people = Tag::where('tag_name', $tag)->firstOrFail()->people;
        return view('person.index')->with(['people' => $people]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return redirect(route('person.index'));
    }
}
