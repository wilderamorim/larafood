@extends('adminlte::page')

@section('title', 'Permissões do Perfil: ' . $profile->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Permissões do Perfil: {{ $profile->name }}</h1>
        <a href="{{ route('permission_profile.permissions.create', ['profile' => $profile->id]) }}" class="btn btn-primary btn-sm">
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
        <div class="card-body">
            @include('admin.includes.alerts')

            @if($permissions->count())
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
                                    <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('permission_profile.permissions.destroy', ['profile' => $profile->id, 'permission' => $permission->id]) }}" method="post" class="d-inline">
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
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif
        </div>
    </div>
@stop
