<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'buyer_name',
        'buyer_username',
        'fee',
        'status',
        'note',
        'transaction_date',
        'deadline',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'deadline' => 'datetime',
        'fee' => 'decimal:2',
    ];

    public function orderItems()
    {  
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}