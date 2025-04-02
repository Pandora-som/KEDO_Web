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

        $query = IncomingLetter::query();
        $queryEndless = IncomingLetter::query();
        $queryEndless->where('deadline', '=', null);

        if (isset($data['start_date']) and isset($data['end_date'])) {
            $query->whereDate('deadline', '>=', $data['start_date'])
            ->whereDate('deadline', '<=', $data['end_date']);
        };

        if (isset($data['lettersGroup'])) {
            if ($data['lettersGroup'] == 'expired') {
                $query->whereDate('deadline', '<', now()->format('Y-m-d'));
            } else if ($data['lettersGroup'] == 'endless') {
                $query = $queryEndless;
            } else {
                $query->whereDate('deadline', '>=', now()->format('Y-m-d'));
            };
        } else {
            $query->whereDate('deadline', '>=', now()->format('Y-m-d'));
        };

        if (isset($data['classificator_id'])) {
            $query->whereIn('classificator_id', $data['classificator_id']);
        }

        if (isset($data['find'])) {
            $query->whereAny(['registration_number', 'document_from', 'document_name', 'document_number', 'document_subject', 'performer', 'resolution'],
            'like', "%{$data['find']}%");
        }
        $incomingLetters = $query->orderBy('deadline', 'ASC')->paginate(10);
        return view('incoming_letter.indexV2', compact(['request', 'incomingLetters', 'classificators']));
    }

    public function create() {
        $document_froms = DocumentFrom::all();
        $document_names = DocumentName::all();
        $performers = Performer::all();
        $statuses = Status::all();
        $classificators = Classificators::all();
        return view('incoming_letter.createV2', compact(['document_froms', 'document_names', 'performers', 'statuses', 'classificators']));
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
        return view('incoming_letter.editV2', compact(['incomingLetter', 'document_froms', 'document_names', 'performers', 'statuses', 'classificators']));
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
        return redirect()->back();
    }
}
