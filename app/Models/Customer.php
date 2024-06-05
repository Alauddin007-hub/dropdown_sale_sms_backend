<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'user_id',
        'status',
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }
}
