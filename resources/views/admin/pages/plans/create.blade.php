@extends('adminlte::page')

@section('title', 'Novo Plano')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Novo Plano</h1>
    </div>

    <!--breadcrumb-->
    {!! !empty($breadcrumb) ? $breadcrumb->render() : null !!}
    <!--/breadcrumb-->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.store') }}" method="post">
                @csrf

                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop
