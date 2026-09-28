<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table(key: 'pessoa_codigo', timestamps: false)]
#[WithoutIncrementing]
class Cliente extends Model
{
    protected $fillable = [
        'pessoa_codigo',
        'nivel_fidelidade',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_codigo');
    }
}
