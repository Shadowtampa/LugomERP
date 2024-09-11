<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_url', 'description', 'category'];

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function price()
    {
        // Obtém todos os preços e filtra aquele onde isSale() é false
        $prices = $this->hasMany(ProductPrice::class)->get();

        foreach ($prices as $price) {
            if (!$price->isSale()) {
                return (float) $price->price; // Exibe o preço do primeiro que não é promocional
            }
        }

        return 0;
    }

    /**
     * Relacionamento com o preço promocional, se existir.
     */
    public function promotionalPrice()
    {
        // Obtém todos os preços e filtra aquele onde isSale() é false
        $prices = $this->hasMany(ProductPrice::class)->get();

        foreach ($prices as $price) {
            if ($price->isSale()) {
                return (float) $price->price; // Exibe o preço do primeiro que não é promocional
            }
        }

        return null;
    }



}

