<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IncomingLetter\FilterRequest;
use App\Models\Classificators;
use App\Models\Destination;
use App\Models\DocumentFrom;
use App\Models\DocumentName;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\Performer;
use App\Models\Signer;
use App\Models\Status;

class IncomingLetterBinController extends Controller
{
    public function index(FilterRequest $request) {
        $classificators = Classificators::all();

        $data = $request->validated();
        $query = IncomingLetter::query();
        if (isset($data['start_date']) and isset($data['end_date'])) {
            $query->whereDate('deadline', '>=', $data['start_date'])
            ->whereDate('deadline', '<=', $data['end_date']);

        };

        if (isset($data['classificator_id'])) {
            $query->where('classificator_id', '=', $data['classificator_id']);
        }

        if (isset($data['expired'])) {
            $query->whereDate('deadline', '<', now()->format('Y-m-d'))->orderBy('deadline', 'ASC');
        } else {
            $query->whereDate('deadline', '>', now()->format('Y-m-d'))->orderBy('deadline', 'ASC');
        }

        if (isset($data['find'])) {
            $query->whereAny(['document_from', 'document_name', 'document_number', 'document_subject', 'performer', 'resolution'],
            'like', "%{$data['find']}%");
        }
        $incomingLetters = $query->onlyTrashed()->paginate(10);
        return view('incoming_letter.bin', compact(['request', 'incomingLetters', 'classificators']));
    }

    public function restore(IncomingLetter $incomingLetter) {
        $incomingLetter->restore();
        return redirect()->route('incoming_letter.bin');
    }

    public function destroy(IncomingLetter $incomingLetter) {
        $incomingLetter->forceDelete();
        return redirect()->route('incoming_letter.bin');
    }
}

