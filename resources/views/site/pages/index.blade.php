@extends('site.base')

@section('content')
    <div class="demo">
        <div class="container">
            <div class="text-center">
                <h1 class="title-plan">Escolha o plano</h1>
            </div>
            <div class="row">
                @foreach($plans as $plan)
                    <div class="col-md-4 col-sm-6">
                        <div class="pricingTable">
                            <div class="pricing-content">
                                <div class="pricingTable-header">
                                    <h3 class="title">{{ $plan->name }}</h3>
                                </div>
                                <div class="inner-content">
                                    <div class="price-value">
                                        <span class="currency">R$</span>
                                        <span class="amount">{{ number_format($plan->price, 2, ',', '.') }}</span>
                                        <span class="duration">Por Mês</span>
                                    </div>
                                    @if($plan->planDetails->count())
                                        <ul>
                                            @foreach($plan->planDetails as $detail)
                                                <li>{{ $detail->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="pricingTable-signup">
                                <a href="#">Assinar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
