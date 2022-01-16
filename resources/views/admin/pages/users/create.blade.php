@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Novo Usuário</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="post">
                @csrf

                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop
