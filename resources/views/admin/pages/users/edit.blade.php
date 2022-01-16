@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Editar Usuário</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
                @csrf
                @method('PUT')

                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop
