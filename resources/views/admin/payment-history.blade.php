@extends('admin.layouts._layout')

@section('content')

	<main class="main-painel history-pay">
		<div class="container">
			<h2>Payments history</h2>

			<div class="table-base">
				<table class="table table-responsive">
					<thead>
					<tr>
						<th>
							Plan
						</th>
						<th>
							Expires on
						</th>
						<th>
							Price
						</th>
						<th>
							Method
						</th>
						<th>
							Renovation
						</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>
							Prime (Semiannual)
						</td>
						<td>
							11/04/2017
						</td>
						<td>
							$150,00
						</td>
						<td>
							Paypal
						</td>
						<td>
							<a href="#" class="btn-green">Automatic</a>
						</td>
					</tr>
					<tr>
						<td>
							Basic (Monthly)
						</td>
						<td>
							Expired
						</td>
						<td>
							$20,00
						</td>
						<td>
							Paypal
						</td>
						<td>
							<a href="#" class="btn-gray">Do not renew</a>
						</td>
					</tr>
					<tr>
						<td>
							Basic (Monthly)
						</td>
						<td>
							Expired
						</td>
						<td>
							$20,00
						</td>
						<td>
							Paypal
						</td>
						<td>
							<a href="#" class="btn-gray">Do not renew</a>
						</td>
					</tr>
					<tr>
						<td>
							Basic (Monthly)
						</td>
						<td>
							Expired
						</td>
						<td>
							R$20,00
						</td>
						<td>
							Paypal
						</td>
						<td>
							<a href="#" class="btn-gray">Do not renew</a>
						</td>
					</tr>
					<tr>
						<td>
							Basic (Monthly)
						</td>
						<td>
							Expired
						</td>
						<td>
							R$20,00
						</td>
						<td>
							Paypal
						</td>
						<td>
							<a href="#" class="btn-gray">Do not renew</a>
						</td>
					</tr>
					</tbody>
				</table>

				<a href="{{ url('/plans') }}" class="btn-orange">Purchase more</a>
				<a href="{{ url('/cancel') }}" class="cancel-subs">I would like to cancel my subscription</a>
			</div>

			<img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
		</div>
	</main>

@stop