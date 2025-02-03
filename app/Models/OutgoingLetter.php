<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutgoingLetter extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function destination() {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }

    public function document_name() {
        return $this->belongsTo(DocumentName::class, 'document_name_id', 'id');
    }

    public function signer() {
        return $this->belongsTo(Signer::class, 'signer_id', 'id');
    }

    public function performer() {
        return $this->belongsTo(Performer::class, 'performer_id', 'id');
    }
}
