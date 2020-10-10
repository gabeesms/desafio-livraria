<?php

namespace App\Services;

use App\Models\Autor;
use Illuminate\Support\Facades\Log;
use Throwable;

class AutorService
{
    public static function store($request)
    {
        try {
            return Autor::create($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }

    public static function update($request, $autor)
    {
        try {
            return $autor->update($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }

    public static function destroy($autor)
    {
        try {
            $autor->livros()->detach();
            return $autor->delete();
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }

    public static function listaAutores($request)
    {
        $termoPesquisa = trim($request->searchTerm);

        if (empty($termoPesquisa)) {
            return Autor::select('id', 'nome as text')->get();
        }

        return Autor::select('id', 'nome as text')
                    ->where('nome', 'like', '%' . $termoPesquisa . '%')
                    ->get();
    }
}