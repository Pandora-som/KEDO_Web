<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class BinController extends Controller
{
    public function index(FilterRequest $request) {
        $classificators = Classificators::all();

        $data = $request->validated();
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
        return view('bin', compact(['request', 'incomingLetters', 'classificators']));
    }
}

