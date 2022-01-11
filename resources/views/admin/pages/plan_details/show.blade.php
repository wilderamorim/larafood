@extends('adminlte::page')

@section('title', $planDetail->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>{{ $planDetail->name }}</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome:</strong> {{ $planDetail->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('plan_details.edit', ['plan' => $plan->slug, 'detail' => $planDetail->id]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('plan_details.destroy', ['plan' => $plan->slug, 'detail' => $planDetail->id]) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
@stop
