<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table(key: 'codigo', timestamps: false)]
class Produto extends Model
{
    protected $fillable = [
        'descricao',
        'preco',
        'estoque',
        'status',
        'categoria_codigo',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_codigo');
    }

}