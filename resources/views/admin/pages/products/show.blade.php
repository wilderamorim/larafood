@extends('adminlte::page')

@section('title', $product->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>{{ $product->name }}</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')

            <figure>
                <img src="{{ !empty($product->image) ? asset("/storage/{$product->image}") : '//placehold.it/360x360' }}" alt="..." width="256" class="img-fluid img-thumbnail">
            </figure>
            <ul>
                <li><strong>Nome:</strong> {{ $product->name }}</li>
                <li><strong>Preço:</strong> {{ number_format($product->price, 2, ',', '.') }}</li>
                <li><strong>Descrição:</strong> {{ $product->description }}</li>
                <li><strong>Empresa:</strong> {{ $product->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('products.destroy', ['product' => $product->id]) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
@stop
