<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessCategoryRequest;
use App\Models\BusinessCategory;

class BusinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $businessCategories = $user->businessCategories()->orderBy('category_name')->paginate(5);
        return view('business_category.index')->with('businessCategories', $businessCategories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('business_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusinessCategoryRequest $request)
    {
        $user = auth()->user();

        $businessCategory = new BusinessCategory($request->validated());
        $businessCategory->user()->associate($user);
        $businessCategory->save();

        return redirect(route('businessCategory.index'))->with('store', 'Business category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessCategory $businessCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessCategory $businessCategory)
    {
        $this->authorize('view', $businessCategory);
        return view('business_category.edit')->with('businessCategory', $businessCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusinessCategoryRequest $request, BusinessCategory $businessCategory)
    {
        $this->authorize('update', $businessCategory);
        $businessCategory->update($request->validated());

        return redirect(route('businessCategory.index'))->with('store', 'Business category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessCategory $businessCategory)
    {
        $this->authorize('delete', $businessCategory);
        $businessCategory->delete();

        return redirect(route('businessCategory.index'))->with('destroy', 'Business category has been deleted successfully');
    }
}
