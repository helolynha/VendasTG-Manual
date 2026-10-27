<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table(key: 'pessoa_codigo', timestamps: false)]
#[WithoutIncrementing]
class Vendedor extends Model
{
    protected $table = 'vendedores';

    protected $fillable = [
        'pessoa_codigo',
        'salario',
        'comissao',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_codigo');
    }
}
