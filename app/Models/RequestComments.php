<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestComments extends Model
{
    use HasFactory;

    protected $table = 'request_comments';
    protected $fillable = [
        'proposal_id',
        'username',
        'position',
        'title',
        'remarks',
    ];

    
}
