@extends('adminlte::page')

@section('title', 'Nova Permissão')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Nova Permissão</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf

                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
