<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PeoplePdfController extends Controller
{
    public function download()
    {
        $user = auth()->user();
        $people = Person::where('user_id', $user->id)->get();

        $pdf = Pdf::loadView('pdf.people', compact('people', 'user'));

        // return $pdf->download();
        return $pdf->stream($user->name. '_contacts_'. Carbon::now() . '.pdf');
    }
}
