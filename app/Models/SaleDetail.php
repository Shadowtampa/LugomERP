<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'trigger', 'negative', 'product_price_id'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function productPrice()
    {
        return $this->belongsTo(ProductPrice::class);
    }
}
