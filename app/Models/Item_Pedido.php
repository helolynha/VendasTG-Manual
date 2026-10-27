<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table(name:'itens_pedidos', timestamps: false, incrementing: false)]
class Item_Pedido extends Model
{
    protected $fillable = [
        'pedido_codigo',
        'produto_codigo',
        'qtd_vendida',
        'preco_unitario',
    ];

}