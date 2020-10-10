<?php

namespace App\Services;

use Illuminate\Support\Str;

class UploadService
{
    const CAPA_LIVRO = 'livros';

    public static function salvarArquivo($arquivo, $pasta)
    {
        $nomeNovo = Str::uuid() . "." . $arquivo->getClientOriginalExtension();

        $diretorio = "public/" . $pasta;

        $arquivo->storeAs($diretorio, $nomeNovo);

        return "$pasta/$nomeNovo";
    }

    public static function getUrlArquivo($arquivo)
    {
        return url('storage/' . $arquivo);
    }
}