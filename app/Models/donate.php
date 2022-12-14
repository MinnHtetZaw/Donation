<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donate extends Model
{
    use HasFactory;

    protected $fillable=[
        'donator_name',
        'donation_amount',
        'category_id',
        'user_id'
    ];
}
