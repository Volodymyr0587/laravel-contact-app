<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrashController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = auth()->user();

        // Merge in one array all deleted contacts
        // $trashedContacts = $user->people()->withTrashed()->whereNotNull('deleted_at')->get()->merge(
        //     $user->businesses()->withTrashed()->whereNotNull('deleted_at')->get()
        // );

        $trashedContacts = $user->people()->onlyTrashed()->get()->merge(
            $user->businesses()->onlyTrashed()->get()
        );

        return view('trash.trash')
            ->with('trashedContacts', $trashedContacts);

    }
}
