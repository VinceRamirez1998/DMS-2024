<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposals extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'proposal',
    'description',
    'username',
    'firstname',
    'lastname',
    'date_created',
    'date_updated',
    ];

}

