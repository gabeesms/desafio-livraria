@extends('adminlte::page')

@section('title', 'Formulário de Autor')

@section('content_header')
    <h1>Formulário de Autor</h1>
@stop

@section('content')
    <div class="card card-primary">
        @if (isset($autor))
            {!! Form::model($autor, ['url' => route('restrito.autors.update', $autor), 'method' => 'put']) !!}
        @else
            {!! Form::open(['url' => route('restrito.autors.store')]) !!}
        @endif
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    @error('nome')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                {!! link_to_route('restrito.autors.index', 'Voltar', null, ['class' => 'btn btn-secondary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop

@section('css')
@stop

@section('js')
@stop