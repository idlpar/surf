<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'total',
        'tax',
        'shipping_cost',
        'discount',
        'total',
        'payment_method',
        'payment_id',
        'billing_address',
        'shipping_address',
        'notes',
        'order_date',
        'canceled_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'order_date' => 'datetime',
        'updated_at' => 'datetime',
        'billing_address' => 'array',
        'shipping_address' => 'array',
    ];

    /**
     * Relationships
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class); // If you have a payments table
    }
    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address');
    }

    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address');
    }


}
