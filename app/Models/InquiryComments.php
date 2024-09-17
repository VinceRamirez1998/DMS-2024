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
        'reply',
        'created_at',
        'updated_at',
    ];
}
