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
    public function index()
    {
        // $people = Person::all();
        // return view('person.index', compact('people'));

        //? Eager Loading:
        //? 1st variant
        // return view('person.index')->with('people', Person::with('business')->get());
        //? 2nd variant (add `protected $with = ['business'];` to `Person` model)
        return view('person.index')->with('people', Person::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('person.create')->with(['businesses' => Business::all(), 'tags' => Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonRequest $request)
    {
        // $validated = $request->validate([
        //     'firstname' => 'required',
        //     'lastname' => 'required',
        //     'email' => 'nullable|email',
        // ]);

        // $person = new Person;

        // $person->firstname = $request->firstname;
        // $person->lastname = $request->lastname;
        // $person->email = $request->email;
        // $person->phone = $request->phone;
        // $person->business_id = $request->business_id;

        // $person->save();
        $person = Person::create($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time() . '_' . $person->firstname . '_' . $person->lastname . '.' . $image->extension();
            // $image->storeAs('images', $imageName, 'public');
            $image->move(public_path('images'), $imageName);
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
        // $validated = $request->validate([
        //     'firstname' => 'required',
        //     'lastname' => 'required',
        //     'email' => 'nullable|email',
        // ]);

        // $person->firstname = $request->firstname;
        // $person->lastname = $request->lastname;
        // $person->email = $request->email;
        // $person->phone = $request->phone;
        // $person->business_id = $request->business_id;

        // $person->save();

        $person->update($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $person->firstname . '_' . $person->lastname . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
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

        // Search in the firstname and lastname columns from the people table
        $people = Person::query()
            ->where('firstname', 'LIKE', "%{$search}%")
            ->orWhere('lastname', 'LIKE', "%{$search}%")
            ->get();

        return view('person.search')->with(['people' => $people, 'search' => $search]);
    }

    public function getByTag($tag)
    {
        $tagModel = Tag::where('tag_name', $tag)->firstOrFail();
        $people = $tagModel->people()->paginate(4);

        return view('person.index', ['people' => $people]);
        // $people = Tag::where('tag_name', $tag)->firstOrFail()->people;
        // return view('person.index')->with(['people' => $people, Person::paginate(10)]);
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
