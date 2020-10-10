<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $fillable = [
        'nome',
        'email'
    ];

    public function livros()
    {
        return $this->belongsToMany(Livro::class);
    }
}
