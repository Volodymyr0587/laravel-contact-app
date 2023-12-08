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
        $people = Person::all();
        $user = auth()->user();

        $pdf = Pdf::loadView('pdf.people', compact('people', 'user'));

        // return $pdf->download();
        return $pdf->stream($user->name. '_contacts_'. Carbon::now() . '.pdf');
    }
}
