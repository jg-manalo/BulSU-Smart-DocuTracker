<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentLog extends Model
{
    use HasFactory;

    protected $table = 'document_logs';
    protected $fillable = [
        'uuid',
        'title',
        'sender',
        'sender_email',
        'sender_dept',
        'recepient',
        'recepient_email',
        'recepient_dept',
        'communication',
        'status',
        'remarks',
        'date_received',
    ];
}
