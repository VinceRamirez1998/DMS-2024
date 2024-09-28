<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = [
        'username',
        'title',
        'position',
        'location',
        'file',
        'status',
        'type',
        'access',
        'inquiry',
        'remarks',
        'department',
        'reply_status',
        'inbox_status'
    ];
}
