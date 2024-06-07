<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name', 'contact_number', 'address', 'added_by', 'added_on', 'created_at', 'updated_at',
    ];
}