@extends('adminlte::page')

@section('title', 'Novo Categoria')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Novo Categoria</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="post">
                @csrf

                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
@stop
