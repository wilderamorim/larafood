@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Usuários</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus-circle"></i>
            Novo
        </a>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <form action="{{ route('users.search') }}" method="post" class="form-inline">
                    @csrf

                    <div class="input-group">
                        <input type="search" name="search" value="{{ $filters['search'] ?? null }}" placeholder="Pesquisar..." aria-label="Pesquisar..." aria-describedby="button-search" class="form-control">
                        <div class="input-group-append">
                            <button type="submit" id="button-search" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if(auth()->user()->id != $user->id)
                                    <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif
        </div>
    </div>
@stop
