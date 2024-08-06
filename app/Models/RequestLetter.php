<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLetter extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'request_letter',
    'description',
    'username',
    'firstname',
    'lastname',
    'date_created',
    'date_updated',
    ];
}
