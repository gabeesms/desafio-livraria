@extends('layouts.livraria')

@section('titulo', 'Livraria Online')

@section('conteudo')
    <div class="row">
        <div class="col-md-4">
            <img src="{{ url("/storage/$livro->capa") }}" class="img-fluid" alt="{{ $livro->nome}}">
        </div>
        
        <div class="col-md-8">
            <div class="row">

                <div class="col-12">
                    <h1>{{ $livro->nome }}</h1>
                </div>

                <div class="col-12">
                    <h4 class="text-danger">R$ {{ $livro->valor }}</h4>
                </div>

                <div class="col-12 mt-4">
                    <p>{{ $livro->descricao }}</p>
                </div>

                <div class="col-12">

                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Ver Autor(es)
                    </button>

                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                           @foreach ($livro->autors as $autor)
                                <p>{{ $autor->nome }} <span class="text-muted">{{ $autor->email }}</span></p>
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection