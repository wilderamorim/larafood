@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Planos</h1>
        <a href="{{ route('plans.create') }}" class="btn btn-primary btn-sm">
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
                <form action="{{ route('plans.search') }}" method="post" class="form-inline">
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

            @if($plans->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->name }}</td>
                                <td>{{ number_format($plan->price, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('profile_plan.profiles.index', ['plan' => $plan->id]) }}" class="btn btn-sm btn-{{ $plan->profiles()->count() ? 'warning' : 'secondary' }}">
                                        <i class="far fa-id-card"></i>
                                    </a>
                                    <a href="{{ route('plan_details.index', ['plan' => $plan->slug]) }}" class="btn btn-sm btn-{{ $plan->planDetails()->count() ? 'success' : 'secondary' }}">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('plans.show', ['plan' => $plan->slug]) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('plans.edit', ['plan' => $plan->slug]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('plans.destroy', ['plan' => $plan->slug]) }}" method="post" class="d-inline">
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
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop
