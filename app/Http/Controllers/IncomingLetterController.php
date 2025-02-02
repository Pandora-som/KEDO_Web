<?php

namespace App\Http\Controllers;

use App\Models\DocumentFrom;
use App\Models\DocumentName;
use App\Models\IncomingLetter;
use App\Models\Performer;
use App\Models\Status;
use Illuminate\Http\Request;

class IncomingLetterController extends Controller
{
    public function create() {
        $document_froms = DocumentFrom::all();
        $document_names = DocumentName::all();
        $performers = Performer::all();
        $statuses = Status::all();
        return view('incoming_letter.create', compact(['document_froms', 'document_names', 'performers', 'statuses']));
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
            'status_id' => 'integer'
        ]);
        IncomingLetter::create($data);
        dd($data);
    }
}
