@extends('admin.layouts._layout')

@section('content')

	<main class="main-painel client-area">
		<div class="container">
			<h2>Customer's Area</h2>

			<div class="table-base clearfix">
				<div class="cover">
					<img src="{{ asset('site/img/escudo.jpg') }}" alt="">
				</div>

				<div class="content clearfix">
					<span class="title">Your subscription</span>
					<div class="left">
						YOUR PLAN
						<span>6 months</span>
					</div>

					<div class="right">
						EXPIRES ON
						<span>11/04/2017</span>
					</div>

					<br style="clear:both;">

					<a href="{{ url('/payment-history') }}" class="btn-blue">Payments history</a>
				</div>

				<div class="btn-section">
					<a href="{{ url('/plans') }}" class="btn-green">UPGRADE</a>
				</div>
			</div>

			<div class="table-base clearfix">
				<div class="cover">
					<img src="{{ asset('site/img/login.jpg') }}" alt="">
				</div>

				<form action="">
					<div class="content clearfix">
						<div class="left">
							<span class="title">Current password</span>

							<input type="password" name="password" class="password">
						</div>
						<div class="right">
							<span class="title">New password</span>

							<input type="password" name="password" class="password">
						</div>
					</div>

					<div class="btn-section">
						<a href="#" class="btn-orange">Confirm</a>
					</div>
			</div>
			</form>

			<div class="table-base clearfix">
				<div class="cover">
					<img src="{{ asset('site/img/cloud.jpg') }}" alt="">
				</div>

				<div class="content clearfix">
					<span class="title">Apps</span>

					<p>Download the latest version<br />SpeedVPN Version: 1.0</p>
				</div>

				<div class="btn-section">
					<a href="{{ url('/download') }}" class="btn-orange">download</a>
				</div>
			</div>

			<div class="table-base clearfix">
				<div class="cover">
					<img src="{{ asset('site/img/heart.jpg') }}" alt="">
				</div>

				<div class="content clearfix">
					<span class="title">Invite a friend</span>

					<p>You and your friend gets one month <br />free if your friend register :D</p>
				</div>

				<div class="btn-section">
					<a href="{{ url('/invites') }}" class="btn-orange">Invite</a>
				</div>
			</div>

			<img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
		</div>
	</main>

@stop