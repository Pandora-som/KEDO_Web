<?php

namespace App\Http\Controllers;

use App\Models\Classificators;
use App\Models\Destination;
use App\Models\DocumentFrom;
use App\Models\DocumentName;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\Performer;
use App\Models\Signer;
use App\Models\Status;
use Illuminate\Http\Request;

class OutgoingLetterController extends Controller
{
    public function index() {
        $outgoingLetters = OutgoingLetter::all();
        return view('outgoing_letter.index', compact("outgoingLetters"));
    }
    public function create() {
        $destinations = Destination::all();
        $document_names = DocumentName::all();
        $performers = Performer::all();
        $signers = Signer::all();
        $classificators = Classificators::all();
        return view('outgoing_letter.create', compact(['destinations', 'document_names', 'performers', 'signers', 'classificators']));
    }

    public function store() {
        $data = request()->validate([
            'registarion_date' => 'date',
            'destination_id' => 'integer',
            'document_name_id' => 'integer',
            'document_subject' => 'string',
            'performer_id' => 'integer',
            'signer_id' => 'integer',
            'incoming_number' => 'integer',
            'classificator_id' => 'integer'
        ]);
        OutgoingLetter::create($data);
        return redirect()->route('outgoing_letter.index');
    }

    public function edit(OutgoingLetter $outgoingLetter) {
        $destinations = Destination::all();
        $document_names = DocumentName::all();
        $performers = Performer::all();
        $signers = Signer::all();
        $classificators = Classificators::all();
        return view('outgoing_letter.edit', compact(['outgoingLetter','destinations', 'document_names', 'performers', 'signers', 'classificators']));
    }

    public function update(OutgoingLetter $outgoingLetter) {
        $data = request()->validate([
            'registarion_date' => 'date',
            'destination_id' => 'integer',
            'document_name_id' => 'integer',
            'document_subject' => 'string',
            'performer_id' => 'integer',
            'signer_id' => 'integer',
            'incoming_number' => 'integer',
            'classificator_id' => 'integer'
        ]);
        $outgoingLetter->update($data);
        return redirect()->route('outgoing_letter.index');
    }

    public function destroy(OutgoingLetter $outgoingLetter) {
        $outgoingLetter->delete();
        return redirect()->route('outgoing_letter.index');
    }
}
