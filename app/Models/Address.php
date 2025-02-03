<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'name',
        'phone',
        'address',
        'locality',
        'city',
        'state',
        'postal_code',
        'country_code',
        'company',
        'is_default',
        'custom_attributes',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'custom_attributes' => 'array', // Automatically converts JSON to an array
    ];

    /**
     * Get the user associated with the address.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to filter default addresses.
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}
