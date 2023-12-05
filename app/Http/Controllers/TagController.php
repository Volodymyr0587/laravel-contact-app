<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $tags = $user->tags()->orderBy('tag_name')->paginate(5);
        return view('tag.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $user = auth()->user();
        $tag = new Tag($request->validated());
        $tag->user()->associate($user);
        $tag->save();

        return redirect(route('tag.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('view', $tag);
        return view('tag.edit')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $this->authorize('update', $tag);
        $tag->update($request->validated());

        return redirect(route('tag.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $tag->delete();

        return redirect(route('tag.index'));
    }
}
