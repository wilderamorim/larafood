@extends('adminlte::page')

@section('title', 'Perfis da Permissão: ' . $permission->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Perfis da Permissão: {{ $permission->name }}</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
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
                                    <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('permission_profile.profiles.destroy', ['permission' => $permission->id, 'profile' => $profile->id]) }}" method="post" class="d-inline">
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
