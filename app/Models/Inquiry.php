<?php

namespace App\Models;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiry';
    protected $fillable = [
        'username',
        'title',
        'position',
        'location',
        'file',
        'status',
        'type',
        'access',
        'remarks',
        'department',
    ];
    
}
