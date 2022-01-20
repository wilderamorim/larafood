@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Perfis</h1>
        <a href="{{ route('profiles.create') }}" class="btn btn-primary btn-sm">
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
                <form action="{{ route('profiles.search') }}" method="post" class="form-inline">
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

            @if($profiles->count())
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
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->name }}</td>
                                <td>{{ $profile->description }}</td>
                                <td>
                                    <a href="{{ route('profile_plan.plans.index', ['profile' => $profile->id]) }}" class="btn btn-sm btn-{{ $profile->plans()->count() ? 'warning' : 'secondary' }}">
                                        <i class="fas fa-list-alt"></i>
                                    </a>
                                    <a href="{{ route('permission_profile.permissions.index', ['profile' => $profile->id]) }}" class="btn btn-sm btn-{{ $profile->permissions()->count() ? 'success' : 'secondary' }}">
                                        <i class="fas fa-tasks"></i>
                                    </a>
                                    <a href="{{ route('profiles.show', ['profile' => $profile->id]) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('profiles.edit', ['profile' => $profile->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('profiles.destroy', ['profile' => $profile->id]) }}" method="post" class="d-inline">
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
            @else
                <div class="alert alert-info" role="alert">
                    No data yet.
                </div>
            @endif
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop
