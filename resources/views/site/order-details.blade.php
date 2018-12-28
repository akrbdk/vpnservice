@extends('site.layouts._layout')

@section('content')

	<main class="main-painel order-detail">
		<div class="container">
			<h2>ORDER DETAIL</h2>

			<div class="table-base clearfix">
				<ul id="detail-list">
					<li><span>PLAN:</span> Prime (Semiannual)</li>
					<li><span>EXPIRES ON:</span> 11/04/2017</li>
					<li><span>DATE OF PURCHASE:</span> 06/05/2017</li>
					<li><span>PRICE:</span> $150,00</li>
					<li><span>METHOD:</span> Paypal</li>
					<li><span>RENOVATION:</span> Automatic</li>
					<li><span>EXPIRES ON:</span> Prime (Semiannual)</li>
				</ul>

				<a href="{{ url('/login') }}" class="btn-gray" download>Back</a>
				<a href="#" class="btn-orange" download>Download in .pdf</a>
			</div>

			<img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
		</div>
	</main>

@stop
