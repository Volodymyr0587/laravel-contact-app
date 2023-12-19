<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $user = auth()->user();
        $numberOfPeople = $user->people()->count();
        $numberOfBusinesses = $user->businesses()->count();
        $numberOfFaforiteContacts = $user->people->where('is_favorite', '1')->merge(
            $user->businesses->where('is_favorite', '1')
        )->count();
        $numberOfTrashedContacts = $user->people()->withTrashed()->whereNotNull('deleted_at')->get()->merge(
            $user->businesses()->withTrashed()->whereNotNull('deleted_at')->get()
        )->count();

        return view('layouts.app')
            ->with(['numberOfPeople' => $numberOfPeople,
                    'numberOfBusinesses' => $numberOfBusinesses,
                    'numberOfFaforiteContacts' => $numberOfFaforiteContacts,
                    'numberOfTrashedContacts' => $numberOfTrashedContacts,
                ]);
    }
}
