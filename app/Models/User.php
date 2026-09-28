<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Define o nome correto da tabela no banco de dados
    protected $table = 'usuarios';

    // Define a chave primária personalizada
    protected $primaryKey = 'codigo';

    // Desative os timestamps caso sua tabela não tenha created_at e updated_at
    public $timestamps = false;

    protected $fillable = [
        'pessoa_codigo',
        'email',
        'senha_hash',
        'nivel',
        'status',
    ];

    protected $hidden = [
        'senha_hash',
    ];

    // Informa ao Laravel qual coluna deve ser usada para verificar a senha
    public function getAuthPassword()
    {
        return $this->senha_hash;
    }
}
