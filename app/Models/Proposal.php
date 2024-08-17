<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposal';
    protected $fillable = [
        'username',
        'title',
        'position',
        'location',
        'file',
        'status',
        'type',
        'remarks',
    ];
    
}
