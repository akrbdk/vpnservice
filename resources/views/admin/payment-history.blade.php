@extends('admin.layouts._layout')

@section('content')

@if (session('alert'))
    <div class="alert-success modal-content recovery-pw" style="display: block;">
        <h2>{{ session('alert') }}</h2>
        <button type="button" class="modal-close btn-green">Ok</button>
    </div>
    <div class="modal" style="display: block;"></div>
@endif

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
