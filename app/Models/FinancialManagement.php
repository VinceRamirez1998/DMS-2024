<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialManagement extends Model
{
    use HasFactory;
    protected $fillable = [
    'budget',
    'description',
    'date_created',
    'date_updated',
    ];
}
