<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'model'];

    public function saleDetail()
    {
        return $this->hasOne(SaleDetail::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class);

    }
}
