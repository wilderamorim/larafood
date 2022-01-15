@extends('adminlte::page')

@section('title', 'Novas Permissões do Perfil: ' . $profile->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Novas Permissões do Perfil: {{ $profile->name }}</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <form action="{{ route('permission_profile.permissions.create', ['profile' => $profile->id]) }}" method="post" class="form-inline">
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

            @if($permissions->count())
                <form action="{{ route('permission_profile.permissions.store', ['profile' => $profile->id]) }}" method="post">
                    @csrf

                    <div class="form-group">
                        @foreach($permissions as $permission)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="permissions[]" id="permission{{ $loop->iteration }}" value="{{ $permission->id }}" class="custom-control-input">
                                <label for="permission{{ $loop->iteration }}" class="custom-control-label">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-success">
                        Salvar
                    </button>
                </form>
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
