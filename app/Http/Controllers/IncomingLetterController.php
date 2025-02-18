<?php

namespace App\Http\Controllers;

use App\Http\Filters\IncomingLetterFilter;
use App\Http\Requests\IncomingLetter\FilterRequest;
use App\Http\Requests\IncomingLetter\StoreRequestFilter;
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
        // $filter = app()->make(IncomingLetterFilter::class, ['queryParams' => array_filter($data)]);
        // $incomingLetters = IncomingLetter::filter($filter)->get();
        $query = IncomingLetter::query();
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
        $incomingLetters = $query->paginate(10);
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

    public function store(StoreRequestFilter $request) {
        $data = $request->validated();

        $document_from = request()->validate([
            'document_from' => 'string'
        ]);

        $document_name = request()->validate([
            'document_name' => 'string'
        ]);

        $performer = request()->validate([
            'performer' => 'string'
        ]);

        DocumentFrom::firstOrCreate([
            'organisation_name' => $document_from['document_from']
        ], [
            'organisation_name' => $document_from['document_from']
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

    public function update(IncomingLetter $incomingLetter, StoreRequestFilter $request) {
        $data = $request->validated();

        $document_from = request()->validate([
            'document_from' => 'string'
        ]);

        $document_name = request()->validate([
            'document_name' => 'string'
        ]);

        $performer = request()->validate([
            'performer' => 'string'
        ]);

        DocumentFrom::firstOrCreate([
            'organisation_name' => $document_from['document_from']
        ], [
            'organisation_name' => $document_from['document_from']
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
