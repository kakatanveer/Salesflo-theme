<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'advance_payment'
    ];

    public function creditItems()
    {
        return $this->hasMany(CreditItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
