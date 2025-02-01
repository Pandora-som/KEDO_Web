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

    public function store(IncomingLetter $incomingLetter) {

        redirect()->route('mainsreen');
    }
}
