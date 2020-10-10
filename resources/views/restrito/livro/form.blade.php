@extends('adminlte::page')

@section('title', 'Formulário de Livro')

@section('content_header')
    <h1>Formulário de Livro</h1>
@stop

@section('content')
    <div class="card card-primary">
        @if (isset($livro))
            {!! Form::model($livro, ['url' => route('restrito.livros.update', $livro), 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
        @else
            {!! Form::open(['url' => route('restrito.livros.store'), 'enctype' => 'multipart/form-data']) !!}
        @endif
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
                    @error('nome')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        {!! Form::label('paginas', 'Páginas') !!}
                        {!! Form::number('paginas', null, ['class' => 'form-control', 'required']) !!}
                        @error('paginas')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        {!! Form::label('valor', 'Valor') !!}
                        {!! Form::number('valor', null, ['class' => 'form-control', 'required']) !!}
                        @error('valor')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('descricao', 'Descrição') !!}
                    {!! Form::textarea('descricao', null, ['class' => 'form-control', 'rows' => 2]) !!}
                    @error('descricao')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('capa', 'Capa') !!}
                    {!! Form::file('capa', ['class' => 'form-control-file', $livro ?? 'required']) !!}
                    @error('capa')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('autor', 'Autor(es)') !!}
                    {!! Form::select('autor[]', [], null, ['class' => 'form-control', 'id' => 'select-autor']) !!}
                    @error('autor')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                {!! link_to_route('restrito.livros.index', 'Voltar', null, ['class' => 'btn btn-secondary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        var livrosSelecionadas = []

        @isset($livro)
            @foreach($livro->autors as $a)
                var c = {
                    id:         {{ $a->id }},
                    text:       '{{ $a->nome }}',
                    selected:   true
                }
                livrosSelecionadas.push(c)
            @endforeach
        @endisset

        $('#select-autor').select2({
            placeholder: 'Lista de autores',
            multiple: true,
            data: livrosSelecionadas,
            ajax: {
                url: '{{ route('restrito.lista.autores') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
            }
        });
    </script>
@stop