<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Get all notes with images for the authenticated user
        $notesWithImages = auth()->user()->notes()->whereNotNull('image')->get();
        $peopleWithImages = auth()->user()->people()->whereNotNull('image')->whereNull('deleted_at')->get();

        return view('gallery.index')->with(['notesWithImages' => $notesWithImages, 'peopleWithImages' => $peopleWithImages]);
    }
}
