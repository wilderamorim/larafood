@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Editar Perfil</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update', ['profile' => $profile->id]) }}" method="post">
                @csrf
                @method('PUT')

                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@stop
