<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard')->with(['candidates' => Candidate::all()]);
    }

    public function voter_update(Request $request): RedirectResponse
    {
        User::find(auth()->id())->update([
            'candidate_id' => $request->candidate_id
        ]);
        return back()->with('message', 'siz Muvaffaqiyatli Ovoz berdingiz!');
    }

    public function voters(): View
    {
        return view("voter.index")->with(['voters' =>  User::role('voter')->get()]);
    }
}
