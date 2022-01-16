@extends('adminlte::page')

@section('title', $category->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>{{ $category->name }}</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')

            <ul>
                <li><strong>Nome:</strong> {{ $category->name }}</li>
                <li><strong>Descrição:</strong> {{ $category->description }}</li>
                <li><strong>Empresa:</strong> {{ $category->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
@stop
