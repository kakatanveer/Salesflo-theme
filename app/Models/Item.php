<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'plates', 'ah', 'limit','stock_quantity' ,'buying_price', 'selling_price', 'added_by', 'added_on',
    ];
}
