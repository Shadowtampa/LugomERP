<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'alias', 'official_name', 'address', 'description', 'contact', 'owner', 'location'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);

    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class);

    }

    public function stocks()
    {
        // Utiliza whereHas para buscar os produtos da loja e seus estoques
        return Stock::whereHas('product', function ($query) {
            $query->whereHas('stores', function ($query) {
                $query->where('store_id', $this->id);
            });
        })->get();
    }
}
