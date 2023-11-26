<?php

namespace App\Http\Controllers;

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
        return view('business.index')->with(['businesses' => Business::withCount('people')->paginate(10), 'tags' => Tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('business.create')->with(['businesses' => Business::all(), 'tags' => Tag::all()]);;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(BusinessRequest $request)
    {

        $business = Business::create($request->validated());

        $business->tags()->sync($request->tags);

        return redirect(route('business.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        return view('business.detail')->with('business', $business);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        return view('business.edit')->with(['business' => $business, 'tags' => Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusinessRequest $request, Business $business)
    {
        $business->update($request->validated());

        $business->tags()->sync($request->tags);

        return redirect(route('business.index'));
    }

    /**
     * Search business
     */
    public function search(Request $request)
    {
        // Get the search value from teh request
        $search = $request->input('search');

        // Search in the business_name column from the business table
        $businesses = Business::query()
            ->where('business_name', 'LIKE', "%{$search}%")
            ->get();

        return view('business.search')->with(['businesses' => $businesses, 'search' => $search]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $business->delete();

        return redirect(route('business.index'));
    }
}
