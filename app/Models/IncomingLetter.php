<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomingLetter extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function document_from() {
        return $this->belongsTo(DocumentFrom::class, 'document_from_id', 'id');
    }

    public function document_name() {
        return $this->belongsTo(DocumentName::class, 'document_name_id', 'id');
    }

    public function performer() {
        return $this->belongsTo(Performer::class, 'performer_id', 'id');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
