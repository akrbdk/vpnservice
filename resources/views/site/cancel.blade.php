@extends('site.layouts._layout')

@section('content')

	<main class="main-painel cancel-plan">
		<div class="container">
			<h2>Cancelling your subscription</h2>

			<div class="table-base clearfix">
				<div class="img-base">
					<img src="{{ asset('site/img/cancelamento.jpg') }}" alt="">
				</div>

				<p class="desc">Sorry to hear you are leaving us :( <br />Please, let us know why:</p>

				<form class="clearfix" action="">
					<div>
						<input type="radio" id="radio1" name="radio" value="" />
						<label for="radio1"><span></span> I believe the product is too expensive.</label>
					</div>
					<div>
						<input type="radio" id="radio2" name="radio" value="" />
						<label for="radio2"><span></span> I will try another VPN service.</label>
					</div>
					<div>
						<input type="radio" id="radio3" name="radio" value="" />
						<label for="radio3"><span></span> I did not like the service's quality.</label>
					</div>
					<div>
						<input type="radio" id="radio4" name="radio" value="" />
						<label for="radio4"><span></span> I had issues with the service.</label>
					</div>
					<div>
						<input type="radio" id="radio5" name="radio" value="" />
						<label for="radio5"><span></span> I had incompatibilities.</label>
					</div>
					<div>
						<input type="radio" id="radio6" name="radio" value="" />
						<label for="radio6"><span></span>Other.</label>
					</div>

					<input type="submit" class="btn-orange" value="Request the cancellation">
				</form>
		</div>
	</main>

@stop