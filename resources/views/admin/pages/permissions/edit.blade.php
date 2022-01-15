@extends('adminlte::page')

@section('title', 'Editar Permissão')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Editar Permissão</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', ['permission' => $permission->id]) }}" method="post">
                @csrf
                @method('PUT')

                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
