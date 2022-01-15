@extends('adminlte::page')

@section('title', 'Novos Perfils do Plano: ' . $plan->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Novos Perfils do Plano: {{ $plan->name }}</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <form action="{{ route('profile_plan.profiles.create', ['plan' => $plan->id]) }}" method="post" class="form-inline">
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
                <form action="{{ route('profile_plan.profiles.store', ['plan' => $plan->id]) }}" method="post">
                    @csrf

                    <div class="form-group">
                        @foreach($profiles as $profile)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="profiles[]" id="profile{{ $loop->iteration }}" value="{{ $profile->id }}" class="custom-control-input">
                                <label for="profile{{ $loop->iteration }}" class="custom-control-label">{{ $profile->name }}</label>
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
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop
