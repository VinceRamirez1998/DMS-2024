<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalComments extends Model
{
    use HasFactory;

    protected $table = 'proposals_comments';
    protected $fillable = [
        'proposal_id',
        'username',
        'position',
        'title',
        'remarks',
    ];

    
}
