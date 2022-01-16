@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Editar Categoria</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post">
                @csrf
                @method('PUT')

                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
@stop
