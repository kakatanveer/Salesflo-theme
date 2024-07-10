<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditItem extends Model
{
    use HasFactory;

    protected $fillable = ['credit_id', 'item_id', 'price', 'quantity', 'item_discount', 'discount_amount', 'total'];

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
