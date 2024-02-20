<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','price'];

    /**
     * Define a relação isSale com SaleDetails.
     */
    public function isSale()
    {
        
        if (SaleDetail::where('product_price_id', $this->id)->first()) {
            return true;
        } else {
            return false;
        }
    }
    

}
