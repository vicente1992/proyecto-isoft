<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'total_amount',
    ];
}
