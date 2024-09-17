<?php

namespace App\Models;

use App\Models\Inquiry;
use App\Models\InquiryComments;
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
        'inquiry',
        'remarks',
        'department',
        'reply_status',
        'inbox_status'
    ];
    
    // public function reply()
    // {
    //     return $this->hasMany(InquiryComments::class, 'inquiry_id');
    // }
}
