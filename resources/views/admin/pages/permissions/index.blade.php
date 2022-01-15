@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Permissões</h1>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus-circle"></i>
            Nova
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
                <form action="{{ route('permissions.search') }}" method="post" class="form-inline">
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
                        <th scope="col">Descrição</th>
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <a href="{{ route('permission_profile.profiles.index', ['permission' => $permission->id]) }}" class="btn btn-sm btn-{{ $permission->profiles()->count() ? 'success' : 'secondary' }}">
                                    <i class="far fa-id-card"></i>
                                </a>
                                <a href="{{ route('permissions.show', ['permission' => $permission->id]) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif
        </div>
    </div>
@stop
