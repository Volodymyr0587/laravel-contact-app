<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('gallery.index');
    }

    public function notesImages(): View
    {
        // Get all notes with images for the authenticated user
        $notesWithImages = auth()->user()->notes()->whereNotNull('image')->paginate(6);

        return view('gallery.notes')->with('notesWithImages', $notesWithImages);
    }

    public function peopleImages(): View
    {
        // Get all people with images for the authenticated user
        $peopleWithImages = auth()->user()->people()->whereNotNull('image')->whereNull('deleted_at')->paginate(6);

        return view('gallery.people')->with('peopleWithImages', $peopleWithImages);
    }
}
