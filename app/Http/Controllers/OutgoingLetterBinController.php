<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OutgoingLetter\FilterRequest;
use App\Models\Classificators;
use App\Models\Destination;
use App\Models\DocumentFrom;
use App\Models\DocumentName;
use App\Models\OutgoingLetter;
use App\Models\Performer;
use App\Models\Signer;
use App\Models\Status;

class OutgoingLetterBinController extends Controller
{
    public function index(FilterRequest $request) {
        $classificators = Classificators::all();

        $data = $request->validated();
        $query = OutgoingLetter::query();
        if (isset($data['start_date']) and isset($data['end_date'])) {
            $query->whereDate('registration_date', '>=', $data['start_date'])
            ->whereDate('registration_date', '<=', $data['end_date']);
        };

        if (isset($data['classificator_id'])) {
            $query->whereIn('classificator_id', $data['classificator_id']);
        }

        if (isset($data['find'])) {
            $query->whereAny(['destination', 'document_name', 'document_subject', 'incoming_number', 'performer', 'signer'],
            'like', "%{$data['find']}%");
        }
        $outgoingLetters = $query->onlyTrashed()->paginate(10);
        return view('outgoing_letter.bin', compact(['request', 'outgoingLetters', 'classificators']));
    }

    public function restore(OutgoingLetter $outgoingLetter) {
        $outgoingLetter->restore();
        return redirect()->route('outgoing_letter.bin');
    }

    public function destroy(OutgoingLetter $outgoingLetter) {
        $outgoingLetter->forceDelete();
        return redirect()->route('outgoing_letter.bin');
    }
}

