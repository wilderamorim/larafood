@extends('adminlte::page')

@section('title', $profile->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>{{ $profile->name }}</h1>
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
                <li><strong>Nome:</strong> {{ $profile->name }}</li>
                <li><strong>Descrição:</strong> {{ $profile->description }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('profiles.edit', ['profile' => $profile->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('profiles.destroy', ['profile' => $profile->id]) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
@stop
