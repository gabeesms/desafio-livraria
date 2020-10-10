@extends('adminlte::page')

@section('title', 'Livros')

@section('content_header')
    <h1>Livros</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    {!! $dataTable->scripts() !!}
@stop