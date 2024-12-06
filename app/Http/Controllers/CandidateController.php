<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondidateRequest;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CandidateController extends Controller
{
    public function index(): View
    {
        return view("candidate.index")->with('candidates', Candidate::all());
    }
    public function store(CondidateRequest $request): RedirectResponse
    {
        if ($request->hasFile('picture')) {

            $file = $request->file('picture');

            $name = $file->getClientOriginalName();

            $picture = basename($file->storeAs('', $name));
        } else {
            $picture = null;
        }

        if ($request->hasFile('resume')) {

            $file = $request->file('resume');

            $name = $file->getClientOriginalName();

            $resume = basename($file->storeAs('', $name));
        } else {
            $resume = null;
        }

        Candidate::create([
            'name' => $request->name,
            'picture' => $picture,
            'resume' => $resume,
            'election_number' => $request->election_number,
        ]);

        return redirect()->route('candidate.index')->with('message', "Nomzod muvoffaqqiyatli qo'shildi");
    }



    public function edit(Candidate $candidate): JsonResponse
    {
        return response()->json($candidate);
    }

    public function update(Request $request, Candidate $candidate): RedirectResponse
    {
        if ($request->hasFile('picture')) {
            if (isset($candidate->picture)) {
                Storage::delete($candidate->picture);
            }
            $file = $request->file('picture');
            $name = $file->getClientOriginalName();
            $picture = basename($file->storeAs('', $name));
        } else {
            $picture = $candidate->picture;
        }

        if ($request->hasFile('resume')) {
            if (isset($candidate->resume)) {
                Storage::delete($candidate->resume);
            }
            $file = $request->file('resume');
            $name = $file->getClientOriginalName();
            $resume = basename($file->storeAs('', $name));
        } else {
            $resume = $candidate->resume;
        }

        $candidate->update([
            'name' => $request->name,
            'picture' => $picture,
            'resume' => $resume,
            'election_number' => $request->election_number,
        ]);

        return redirect()->route('candidate.index')->with('message', "Nomzod muvoffaqqiyatli o'zgartirildi");
    }

    public function destroy(Candidate $candidate): RedirectResponse
    {
        if ($candidate->picture) {
            Storage::delete($candidate->picture);
        }

        if ($candidate->resume) {
            Storage::delete($candidate->resume);
        }

        $candidate->delete();

        return redirect()->route('candidate.index')->with('message', "Nomzod muvoffaqqiyatli o'chirildi");
    }

    public function downloadResume(Candidate $candidate)
    {
        if (!$candidate->resume || !Storage::exists('/' . $candidate->resume)) {
            return redirect()->back()->with('message', 'Fayl topilmadi!');
        }

        return Storage::download('/' . $candidate->resume);
    }
}
