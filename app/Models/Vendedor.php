<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table(name:'vendedores', key:'codigo', timestamps: false, incrementing: false)]
class Vendedor extends Model
{
    //
}