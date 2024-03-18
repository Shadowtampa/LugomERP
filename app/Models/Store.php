<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'alias', 'official_name', 'address', 'description', 'contact', 'owner', 'location'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);

    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class);

    }
}
