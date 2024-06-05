<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;

    protected $table = 'sale_details';
    protected $fillable = [
        'book_id',
        'sales_id',
        'quantity',
        'price',
        'subtotal',
        'status',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function sale(){
        return $this->belongsTo(Sale::class, 'sales_id');
    }

   
}
