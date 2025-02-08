<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'name',
        'phone',
        'email',
        'subject',
        'message',
        'is_read',
    ];
}

