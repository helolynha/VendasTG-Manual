<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table(key: 'codigo', timestamps: false)]
class Pessoa extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'status',
    ];

}