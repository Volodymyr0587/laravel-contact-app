<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Models\Business;
use App\Models\Person;
use App\Models\Tag;

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

        $person->tags()->sync($request->tags);

        return redirect(route('person.index'));
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
