<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'contact_number', 'payment_type', 'account_number'];

    public function sellItems()
    {
        return $this->hasMany(SellItem::class);
    }
}
