@extends('adminlte::page')

@section('title', $plan->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>{{ $plan->name }}</h1>
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
                <li><strong>Nome:</strong> {{ $plan->name }}</li>
                <li><strong>Preço:</strong> {{ number_format($plan->price, 2, ',', '.') }}</li>
                <li><strong>Descrição:</strong> {{ $plan->description }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('plan_details.index', ['plan' => $plan->slug]) }}" class="btn btn-secondary">
                <i class="fas fa-info-circle"></i>
            </a>
            <a href="{{ route('plans.edit', ['plan' => $plan->slug]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('plans.destroy', ['plan' => $plan->slug]) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
@stop
