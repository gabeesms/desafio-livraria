<?php

namespace App\Http\Controllers\Restrito;

use App\DataTables\AutorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorRequest;
use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(AutorDataTable $autorDataTable)
    {
        return $autorDataTable->render('restrito.autor.index');
    }

    public function create()
    {
        return view('restrito.autor.form');
    }

    public function store(AutorRequest $request)
    {
        $autor = AutorService::store($request->all());

        if ($autor) {
            return redirect()->route('restrito.autors.index')
                        ->withSucesso('Autor salvo com sucesso');
        }

        return back()->withInput()
                    ->withFalha('Erro ao salvar o autor');
    }

    public function edit(Autor $autor)
    {
        
        return view('restrito.autor.form', compact('autor'));
    }

    public function update(AutorRequest $request, Autor $autor)
    {
        $autor = AutorService::update($request->all(), $autor);

        if ($autor) {
            return redirect()->route('restrito.autors.index')
                        ->withSucesso('Autor atualizado com sucesso');
        }

        return back()->withInput()
                    ->withFalha('Erro ao atualizar o autor');
    }

    public function destroy(Autor $autor)
    {
        $deleteAutor = AutorService::destroy($autor);

        if ($deleteAutor) {
            return response('Apagado com sucesso', 200);
        }

        return response('Erro ao apagar', 400);
    }

    public function listaAutores(Request $request)
    {
        return AutorService::listaAutores($request);
    }
}
