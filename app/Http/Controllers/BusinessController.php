<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\Tag;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Requests\BusinessRequest;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $businesses = $user->businesses()->withCount('people')->paginate(10);
        return view('business.index')->with(['businesses' => $businesses, 'tags' => Tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = auth()->user()->tags()->get();
        $businessCategories = auth()->user()->businessCategories()->orderBy('category_name')->get();
        return view('business.create')->with(['businesses' => Business::all(), 'tags' => $tags, 'categories' => $businessCategories]);;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(BusinessRequest $request)
    {
        $user = auth()->user();

        $business = new Business($request->validated());
        $business->user()->associate($user);
        $business->save();

        $business->categories()->sync($request->category_id);

        $business->tags()->sync($request->tags);

        return redirect(route('business.index'))->with('store', 'Business created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        $this->authorize('view', $business);

        return view('business.detail')->with('business', $business);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        $this->authorize('view', $business);

        $categories = auth()->user()->businessCategories()->orderBy('category_name')->get();

        return view('business.edit')->with(['business' => $business, 'tags' => Tag::all(), 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusinessRequest $request, Business $business)
    {
        $this->authorize('update', $business);

        $business->update($request->validated());

        $business->categories()->sync($request->category_id);

        $business->tags()->sync($request->tags);

        return redirect(route('business.index'))->with('store', 'Business updated successfully');
    }

    /**
     * Search business
     */
    public function search(Request $request)
    {
        // Get the search value from teh request
        $search = $request->input('search');

        // Search in the business_name column from the business table
        $businesses = auth()->user()->businesses()->withCount('people')
            ->where('business_name', 'LIKE', "%{$search}%")
            ->get();

        return view('business.search')->with(['businesses' => $businesses, 'search' => $search]);
    }

    public function getByTag($tag)
    {
        $tagModel = Tag::where('tag_name', $tag)->firstOrFail();
        $businesses = $tagModel->businesses()->withCount('people')
            ->where('user_id', auth()->id())->paginate(4);

        return view('business.index', ['businesses' => $businesses]);
    }

    public function getByCategory($category)
    {
        $categoryModel = BusinessCategory::where('category_name', $category)->firstOrFail();
        $businesses = $categoryModel->business()->withCount('people')
            ->where('user_id', auth()->id())->paginate(4);

        return view('business.index', ['businesses' => $businesses]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $this->authorize('delete', $business);
        $business->tasks()->delete();
        $business->delete();

        return redirect(route('business.index'))->with('destroy', 'Business has been deleted successfully');
    }
}
