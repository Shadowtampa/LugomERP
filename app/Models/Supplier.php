<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj_cpf',
        'address',
        'phone',
        'email',
        'site',
        'responsibility',
    ];

    // Definindo os tipos de dados dos campos
    protected $casts = [
        'name' => 'string',
        'cnpj_cpf' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'site' => 'string',
        'responsibility' => 'string',
    ];
}
