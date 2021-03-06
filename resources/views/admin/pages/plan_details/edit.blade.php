@extends('adminlte::page')

@section('title', 'Editar Detalhe do Plano: ' . $plan->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Editar Detalhe do Plano: {{ $plan->name }}</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plan_details.update', ['plan' => $plan->slug, 'detail' => $planDetail->id]) }}" method="post">
                @csrf
                @method('PUT')

                @include('admin.pages.plan_details._partials.form')
            </form>
        </div>
    </div>
@stop
