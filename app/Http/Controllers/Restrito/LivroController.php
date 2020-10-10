<?php

namespace App\Http\Controllers\Restrito;

use App\DataTables\LivroDataTable;
use App\Http\Controllers\Controller;
use App\Models\Livro;
use App\Services\LivroService;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index(LivroDataTable $livroDataTable)
    {
        return $livroDataTable->render('restrito.livro.index');
    }

    public function create()
    {
        return view('restrito.livro.form');
    }

    public function store(Request $request)
    {
        $livro = LivroService::store($request->all());

        if ($livro) {
            return redirect()->route('restrito.livros.index')
                        ->withSucesso('Livro salvo com sucesso');
        }

        return back()->withInput()
                    ->withFalha('Erro ao salvar o livro');
    }

    public function edit(Livro $livro)
    {
        return view('restrito.livro.form', compact('livro'));
    }

    public function update(Request $request, Livro $livro)
    {
        $livro = LivroService::update($request->all(), $livro);

        if ($livro) {
            return redirect()->route('restrito.livros.index')
                        ->withSucesso('Livro atualizado com sucesso');
        }

        return back()->withInput()
                    ->withFalha('Erro ao atualizar o livro');
    }

    public function destroy(Livro $livro)
    {
        $deleteLivro = LivroService::destroy($livro);

        if ($deleteLivro) {
            return response('Apagado com sucesso', 200);
        }

        return response('Erro ao apagar', 400);
    }
}
