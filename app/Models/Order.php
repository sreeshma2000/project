<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasmany(OrderItem::class);
    }
    public function shipping()
    {
        return $this->hasone(Shipping::class);
    }
    public function transaction()
    {
        return $this->hasone(Transaction::class);
    }
}
