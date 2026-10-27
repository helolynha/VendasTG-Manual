<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Expression;

#[Table(key: 'codigo', timestamps: false)]
class Pedido extends Model
{
    protected $fillable = [
        'data',
        'total',
        'cliente_codigo',
        'status',
        'vendedor_codigo',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_codigo');
    }

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_codigo');
    }
}