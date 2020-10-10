<?php

namespace App\Http\Controllers;
use App\Models\Livro;

use Illuminate\Http\Request;

class IndexController extends Controller

{
    public function index()
    {
        $livros = Livro::paginate(4);

        return view('index', compact('livros'));
    }

    public function livro(Livro $livro)
    {
       return view('detalhes', compact('livro'));
    }
}
