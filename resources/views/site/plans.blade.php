@extends('site.layouts._layout')

@section('content')

	<div class="bg-gray"></div>

	<main class="main-painel finish-plan">
		<div class="container">
			<div class="title-c clearfix">
				<span class="number">1</span>

				<div class="title-desc">
					<h2>CHOOSE YOUR PLAN</h2>
					<p>7-Day Warranty or your Money Back.</p>
				</div>
			</div>

			<section id="choose-plan">
				<div class="container">
					<ul id="plan-list" class="clearfix">
						<li class="plan-free">
							<div class="title">Free</div>
							<div class="price">
								<span class="currency">$</span>
								<span class="coin">0</span>
								<span class="cents">.00</span>
							</div>
							<div class="plan-type">
								Per month
							</div>

							<ul class="feature-list">
								<li>Without credit card</li>
								<li>Without disconnections every minute</li>
								<li>Normal speed</li>
							</ul>

							<span class="trial">3 days free</span>
							<a href="{{ url('/login') }}" class="btn-orange">test 3 days free</a>
						</li>
						<li class="plan-basic most-pop">
							<div class="title">Basic</div>
							<div class="price">
								<span class="currency">$</span>
								<span class="coin">4</span>
								<span class="cents">.90</span>
							</div>
							<div class="plan-type">
								Per month
							</div>

							<ul class="feature-list">
								<li>50 servers</li>
								<li>Basic support</li>
								<li>Normal speed</li>
							</ul>

							<select name="plan-period" id="plan-period">
								<option value="anual">Anual - 51% of discount</option>
								<option value="anual">Anual - 51% of discount</option>
								<option value="anual">Anual - 51% of discount</option>
							</select>

							<a href="{{ url('/login') }}" class="btn-green">Subscribe now</a>
						</li>
						<li>
							<div class="title">
								<span>The most popular</span>
								Prime
							</div>
							<div class="price">
								<span class="currency">$</span>
								<span class="coin">6</span>
								<span class="cents">.90</span>
							</div>
							<div class="plan-type">
								Per month
							</div>

							<ul class="feature-list">
								<li>More than 100 servers</li>
								<li>High connection speed</li>
								<li>Support premium</li>
							</ul>

							<select name="plan-period" id="plan-period">
								<option value="anual">Anual - 54% of discount</option>
								<option value="anual">Anual - 54% of discount</option>
								<option value="anual">Anual - 54% of discount</option>
							</select>

							<a href="{{ url('/login') }}" class="btn-green">Subscribe now</a>
						</li>
					</ul>
				</div>

				<div class="warn-section clearfix">
					<div class="icon"></div>
					<p>We would like to remind you that the annual option will save you even more.</p>
				</div>

				<div class="advantages">
					<h3>More advantages of the basic plan</h3>

					<ul class="list">
						<li>Support 24 hours a day <br />7 days a week..</li>
						<li>Windows application <br />Soon:</li>
						<li>The best in security and <br />encryption. </li>
						<li>Unlmited traffic and servers <br />exchanges.</li>
						<li>Automatic Kill Switch.</li>
						<li>Don't save your logs.</li>
						<li>Ultra fast in more <br />than x countries.</li>
						<li>Guaranteed refund<br />(7 days).</li>
					</ul>
				</div>
			</section>

			<div class="title-c clearfix">
				<span class="number">2</span>

				<div class="title-desc">
					<h2>IDENTIFICATION</h2>
					<p>We are not going to share any of your information with any third-party.</p>
				</div>
			</div>

			<form class="clearfix identificacao" action="">
				<div class="clearfix">
					<label for="email">E-MAIL</label>
					<input type="email" name="email" class="email" placeholder="Type your friend's email">
				</div>

				<div class="clearfix">
					<label for="password">PASSWORD</label>
					<input type="password" class="password" name="password">
					<a href="javascript:void(0);" onclick="modal();">Forgotten your password?</a>
				</div>
			</form>

			<div class="title-c clearfix">
				<span class="number">2</span>

				<div class="title-desc">
					<h2>Payment</h2>
					<p>Choose the best payment method for you.</p>
				</div>
			</div>

			<div class="checkout">
				<div class="cartao-credito payment-item">
					<span><img src="{{ asset('site/img/planos.jpg') }}" alt="">  credit/debit card</span>

					<div class="content">
						<div class="cover">
							<img src="{{ asset('site/img/cc.jpg') }}" alt="">
						</div>

						<input type="text" name="nome" class="nome" placeholder="Nome do títular">
						<input type="text" name="ncartao" class="ncartao" placeholder="Número do cartão">

						<input type="text" name="mes" class="mes" placeholder="Mês (mm)">
						<input type="text" name="ano" class="ano" placeholder="Ano (yy)">
						<input type="text" name="ccv" class="ccv" placeholder="CCV">

						<br style="clear:both;">
						<p>Every 6 months the plan will be renewed automatically. You can cancel at any time.</p>

						<div class="total">
							total: <span>$ 47.40</span>
						</div>
						<a href="{{ url('#') }}" class="btn-green">Pay now</a>

						<br style="clear:both;">
						<p class="termos-servico">By proceeding you will agree to the <span> terms of service</span>.</p>
					</div>
				</div>

				<div class="boleto payment-item">
					<span><img src="{{ asset('site/img/planos.jpg') }}" alt="">  boleto bancário</span>

					<div class="content">
						<p>A opção por boleto bancário não permite renovação automática.</p>

						<div class="cupom">
							<p>Possuí um  cupom? Clique aqui.</p>

							<input type="text" name="cupom2" class="cupom2" placeholder="digite um cupom válido">
						</div>
						<div class="total">
							total: <span>$ 47.40</span>
						</div>
						<a href="{{ url('#') }}" class="btn-green">Pagar Agora</a>

						<br style="clear:both;">
						<p class="termos-servico">Ao prosseguir você concordará com os <span> termos de serviçom</span>.</p>
					</div>
				</div>

				<div class="paypal payment-item">
					<span><img src="{{ asset('site/img/planos.jpg') }}" alt="">  Paypal</span>

					<div class="content">
						<div class="cupom">
							<p>Do you have a discount coupon? Click here.</p>

							<input type="text" name="cupom2" class="cupom2" placeholder="digite um cupom válido">
						</div>
						<div class="total">
							total: <span>$ 47.40</span>
						</div>
						<a href="{{ url('#') }}" class="btn-green">Pay now</a>

						<br style="clear:both;">
						<p class="termos-servico">By proceeding you agree to the <span> terms of service</span>.</p>
					</div>
				</div>

				<div class="bitcoin payment-item">
					<span><img src="{{ asset('site/img/planos.jpg') }}" alt="">  Bitcoin</span>

					<div class="content">
						<div class="cupom">
							<p>Do you have a discount coupon? Click here.</p>

							<input type="text" name="cupom2" class="cupom2" placeholder="digite um cupom válido">
						</div>

						<div class="bitcoin-detail">
							Send the bitcoins to:<br />
							15hauSOW827nsiqoKoq86m<br />
							abaKJU826abnsoUHAYGSmnajs

							<img src="{{ asset('site/img/qrcode-bitcoin.jpg') }}" alt="">
						</div>

						<div class="total">
							total: <span>BTC 0.012345</span>
						</div>
						<a href="{{ url('#') }}" class="btn-green">Pay now</a>

						<br style="clear:both;">
						<p class="termos-servico">By proceeding you agree to the <span> terms of service</span>.</p>
					</div>
				</div>
			</div>

		</div>
	</main>

@stop