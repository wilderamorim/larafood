@extends('adminlte::page')

@section('title', 'Novo Produto')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Novo Produto</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop
