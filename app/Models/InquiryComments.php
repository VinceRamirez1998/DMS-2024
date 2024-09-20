<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryComments extends Model
{
    use HasFactory;
    protected $table = 'inquiry_comments';
    protected $fillable = [
        'id',
        'inquiry_id',
        'username',
        'reply',
        'position',
        'created_at',
        'updated_at',
    ];
}
