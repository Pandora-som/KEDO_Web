<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutgoingLetter\FilterRequest;
use App\Http\Requests\OutgoingLetter\StoreFilterRequest;
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
    public function index(FilterRequest $request) {
        $classificators = Classificators::all();

        $data = $request->validated();
        // $filter = app()->make(IncomingLetterFilter::class, ['queryParams' => array_filter($data)]);
        // $incomingLetters = IncomingLetter::filter($filter)->get();
        $query = OutgoingLetter::query();
        if (isset($data['start_date']) and isset($data['end_date'])) {
            $query->whereDate('registration_date', '>=', $data['start_date'])
            ->whereDate('registration_date', '<=', $data['end_date']);

        } elseif (isset($data['end_date']) and isset($data['start_date']) and ($data['start_date'] > $data['end_date'])) {
            $data['end_date'] = $data['start_date'];
            $query->whereDate('registration_date', '=', $data['start_date']);
        };

        if (isset($data['classificator_id'])) {
            $query->where('classificator_id', '=', $data['classificator_id']);
        }
        $outgoingLetters = $query->paginate(10);
        return view('outgoing_letter.indexV2', compact(['request', "outgoingLetters", 'classificators']));
    }
    public function create() {
        $destinations = Destination::all();
        $document_names = DocumentName::all();
        $performers = Performer::all();
        $signers = Signer::all();
        $classificators = Classificators::all();
        return view('outgoing_letter.createV2', compact(['destinations', 'document_names', 'performers', 'signers', 'classificators']));
    }

    public function store(StoreFilterRequest $request) {
        $data = $request->validated();

        $destination = request()->validate([
            'destination' => 'string'
        ]);

        $document_name = request()->validate([
            'document_name' => 'string'
        ]);

        $performer = request()->validate([
            'performer' => 'string'
        ]);

        $signer = request()->validate([
            'signer' => 'string'
        ]);

        Destination::firstOrCreate([
            'destination_name' => $destination['destination']
        ], [
            'destination_name' => $destination['destination']
        ]);

        DocumentName::firstOrCreate([
            'name' => $document_name['document_name']
        ], [
            'name' => $document_name['document_name']
        ]);

        Performer::firstOrCreate([
            'performer_name' => $performer['performer']
        ], [
            'performer_name' => $performer['performer']
        ]);

        Signer::firstOrCreate([
            'signer_name' => $signer['signer']
        ], [
            'signer_name' => $signer['signer']
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

    public function update(OutgoingLetter $outgoingLetter, StoreFilterRequest $request) {
        $data = $request->validated();

        $destination = request()->validate([
            'destination' => 'string'
        ]);

        $document_name = request()->validate([
            'document_name' => 'string'
        ]);

        $performer = request()->validate([
            'performer' => 'string'
        ]);

        $signer = request()->validate([
            'signer' => 'string'
        ]);

        Destination::firstOrCreate([
            'destination_name' => $destination['destination']
        ], [
            'destination_name' => $destination['destination']
        ]);

        DocumentName::firstOrCreate([
            'name' => $document_name['document_name']
        ], [
            'name' => $document_name['document_name']
        ]);

        Performer::firstOrCreate([
            'performer_name' => $performer['performer']
        ], [
            'performer_name' => $performer['performer']
        ]);

        Signer::firstOrCreate([
            'signer_name' => $signer['signer']
        ], [
            'signer_name' => $signer['signer']
        ]);

        $outgoingLetter->update($data);
        return redirect()->route('outgoing_letter.index');
    }

    public function destroy(OutgoingLetter $outgoingLetter) {
        $outgoingLetter->delete();
        return redirect()->route('outgoing_letter.index');
    }
}
