<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        'nome',
        'paginas',
        'capa',
        'descricao',
        'valor'
    ];

    public function autors()
    {
        return $this->belongsToMany(Autor::class);
    }
}
