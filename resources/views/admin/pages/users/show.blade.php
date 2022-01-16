@extends('adminlte::page')

@section('title', $user->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>{{ $user->name }}</h1>
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
                <li><strong>Nome:</strong> {{ $user->name }}</li>
                <li><strong>E-mail:</strong> {{ $user->email }}</li>
                <li><strong>Empresa:</strong> {{ $user->tenant->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            @if(auth()->user()->id != $user->id)
                <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>
@stop
