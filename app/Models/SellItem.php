<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellItem extends Model
{
    use HasFactory;

    protected $fillable = ['sell_id', 'item_id', 'price', 'quantity', 'item_discount', 'discount_amount', 'total'];

    public function sell()
    {
        return $this->belongsTo(Sell::class);
    }
}
