<?php

namespace App\Services;

use App\Models\Livro;
use Illuminate\Support\Facades\Log;
use Throwable;

class LivroService
{
    public static function store($request)
    {
        try {
            $request['capa'] = UploadService::salvarArquivo($request['capa'], UploadService::CAPA_LIVRO);

            $livro = Livro::create($request);

            $livro->autors()->sync($request['autor']);

            return $livro;
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }

    public static function update($request, $livro)
    {
        try {
            if (isset($request['capa'])) {
                $request['capa'] = UploadService::salvarArquivo($request['capa'], UploadService::CAPA_LIVRO);
            }

            return $livro->update($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }

    public static function destroy($livro)
    {
        try {
            $livro->autors()->detach();
            return $livro->delete();
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }
}