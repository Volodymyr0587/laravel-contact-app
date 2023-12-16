<?php

namespace App\Http\Controllers;


class FavoriteContactsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = auth()->user();

        // Merge in one array all favorite contacts
        $favoriteContacts = $user->people->where('is_favorite', '1')->merge(
            $user->businesses->where('is_favorite', '1')
        );

        return view('favorite_contacts.favorite')
            ->with('favoriteContacts', $favoriteContacts);
    }
}
