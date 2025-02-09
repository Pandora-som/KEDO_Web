<?php

namespace App\Http\Controllers;

use App\Http\Filters\IncomingLetterFilter;
use App\Http\Requests\IncomingLetter\FilterRequest;
use App\Models\Classificators;
use App\Models\DocumentFrom;
use App\Models\DocumentName;
use App\Models\IncomingLetter;
use App\Models\Performer;
use App\Models\Status;
use Illuminate\Http\Request;

class IncomingLetterController extends Controller
{
    public function index(FilterRequest $request) {
        $classificators = Classificators::all();

        $data = $request->validated();
        $filter = app()->make(IncomingLetterFilter::class, ['queryParams' => array_filter($data)]);
        $incomingLetters = IncomingLetter::filter($filter)->get();

        return view('incoming_letter.index', compact(['request', 'incomingLetters', 'classificators']));
    }

    public function create() {
        $document_froms = DocumentFrom::all();
        $document_names = DocumentName::all();
        $performers = Performer::all();
        $statuses = Status::all();
        $classificators = Classificators::all();
        return view('incoming_letter.create', compact(['document_froms', 'document_names', 'performers', 'statuses', 'classificators']));
    }

    public function store() {
        $data = request()->validate([
            'registration_date' => 'date',
            'document_from_id' => 'integer',
            'document_name_id' => 'integer',
            'document_number' => 'integer',
            'document_date' => 'date',
            'document_subject' => 'string',
            'resolution' => 'string',
            'performer_id' => 'integer',
            'deadline' => 'date',
            'status_id' => 'integer',
            'classificator_id' => 'integer'
        ]);
        IncomingLetter::create($data);
        return redirect()->route('incoming_letter.index');
    }

    public function edit(IncomingLetter $incomingLetter) {
        $document_froms = DocumentFrom::all();
        $document_names = DocumentName::all();
        $performers = Performer::all();
        $classificators = Classificators::all();
        $statuses = Status::all();
        return view('incoming_letter.edit', compact(['incomingLetter', 'document_froms', 'document_names', 'performers', 'statuses', 'classificators']));
    }

    public function update(IncomingLetter $incomingLetter) {
        $data = request()->validate([
            'registration_date' => 'date',
            'document_from_id' => 'integer',
            'document_name_id' => 'integer',
            'document_number' => 'integer',
            'document_date' => 'date',
            'document_subject' => 'string',
            'resolution' => 'string',
            'performer_id' => 'integer',
            'deadline' => 'date',
            'status_id' => 'integer',
            'classificator_id' => 'integer'
        ]);
        $incomingLetter->update($data);
        $document_froms = DocumentFrom::all();
        $document_names = DocumentName::all();
        $performers = Performer::all();
        $statuses = Status::all();
        $classificators = Classificators::all();
        return redirect()->route('incoming_letter.index', compact(['document_froms', 'document_names', 'performers', 'statuses', 'classificators']));
    }
    public function destroy(IncomingLetter $incomingLetter) {
        $incomingLetter->delete();
        return redirect()->route('incoming_letter.index');
    }
}
