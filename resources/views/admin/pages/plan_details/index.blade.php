@extends('adminlte::page')

@section('title', 'Detalhes do Plano: ' . $plan->name)

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Detalhes do Plano: {{ $plan->name }}</h1>
        <a href="{{ route('plan_details.create', ['plan' => $plan->slug]) }}" class="btn btn-primary btn-sm">
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
        <div class="card-body">
            @include('admin.includes.alerts')

            @if($planDetails->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($planDetails as $planDetail)
                            <tr>
                                <td>{{ $planDetail->name }}</td>
                                <td>
                                    <a href="{{ route('plan_details.show', ['plan' => $plan->slug, 'detail' => $planDetail->id]) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('plan_details.edit', ['plan' => $plan->slug, 'detail' => $planDetail->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form onsubmit="return confirm('Tem certeza que deseja excluir?');" action="{{ route('plan_details.destroy', ['plan' => $plan->slug, 'detail' => $planDetail->id]) }}" method="post" class="d-inline">
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
                {!! $planDetails->appends($filters)->links() !!}
            @else
                {!! $planDetails->links() !!}
            @endif
        </div>
    </div>
@stop
