@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Editar Plano</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', ['plan' => $plan->slug]) }}" method="post">
                @csrf
                @method('PUT')

                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop
