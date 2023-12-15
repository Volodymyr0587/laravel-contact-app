<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PersonRequest;
use App\Models\User;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $people = $user->people()->orderBy('firstname')
                    ->orderBy('lastname')->get();

        return $people;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        return $person;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Person::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonRequest $request, string $id)
    {
        $person = Person::find($id);

        $this->authorize('update', $person);
        $person->update($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images');
            $person->image = $path;
            $person->save();
        }

        $person->tags()->sync($request->tags);

        return $person;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $this->authorize('delete', $id);

        return Person::destroy($id);
    }
}
