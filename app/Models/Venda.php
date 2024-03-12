<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'client_id', 'final_price', 'payment_method', 'status', 'delivery_address'
    ];


    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Modelo Venda
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_venda')->withPivot('quantity');
    }
}
