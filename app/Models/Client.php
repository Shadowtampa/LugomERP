<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'cpf_cnpj', 'birthdate', 'gender', 'status',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }
}
