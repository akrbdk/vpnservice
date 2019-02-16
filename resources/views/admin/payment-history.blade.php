@extends('admin.layouts._layout')

@section('content')

<main class="main-painel history-pay">
		<div class="container">
				<h2>Payments history</h2>

				<div class="table-base">
						<table class="table table-responsive">
							@include('site.paymentlist', ['payment' => App\PaymentHistory::index(Auth::id())->reverse()])


						<a href="{{ url('/plans') }}" class="btn-orange">Purchase more</a>
						<a href="{{ url('/cancel') }}" class="cancel-subs">I would like to cancel my subscription</a>
				</div>

				<img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
		</div>
</main>

@stop
