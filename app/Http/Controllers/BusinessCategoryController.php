<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessCategoryRequest;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('business_category.index')->with('businessCategories', BusinessCategory::paginate(5));
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
        BusinessCategory::create($request->validated());

        return redirect(route('businessCategory.index'));
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
        return view('business_category.edit')->with('businessCategory', $businessCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusinessCategoryRequest $request, BusinessCategory $businessCategory)
    {
        $businessCategory->update($request->validated());

        return redirect(route('businessCategory.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessCategory $businessCategory)
    {
        $businessCategory->delete();

        return redirect(route('businessCategory.index'));
    }
}
