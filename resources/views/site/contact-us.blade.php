@extends('site.layouts._layout')

@section('content')

	<main id="main" class="fale-conosco">
		<section class="pro-con">
			<div class="container">
				<h2>Contact us</h2>

				<div class="talk-us">
					<div class="mail">
						<div class="cover">
							<img src="{{ asset('site/img/mail_icon.jpg') }}" alt="">
						</div>
						<div class="touch">
							<a href="{{ url('/send-us-an-email') }}" class="btn-orange">EMAIL</a>
							<p>Usually, we reply within: a few hours.</p>
						</div>
					</div>
				</div>

				<div class="chat-us">
					<div class="chat">
						<div class="cover">
							<img src="{{ asset('site/img/chat_icon.jpg') }}" alt="">
						</div>
						<div class="touch">
							<a href="javascript:void(Tawk_API.toggle())" class="btn-blue">Chat Online</a>
							<p>Usually, we reply within: a few minutes.</p>
							<p id="status" class="chat-status alexoff online"></p>
						</div>
					</div>

				</div>

					<div class="face-us">
						<div class="mail">
							<div class="cover">
								<img src="{{ asset('site/img/facebook_icon.jpg') }}" alt="">
							</div>
							<div class="touch">
								<a href="http://www.facebook.com" class="btn-facebook">facebook fanpage</a>
								<p>Usually, we reply within: a few hours.</p>
							</div>
						</div>
					</div>
			</div>
		</section>

		<section id="faq">
			<div class="container">
				<h3>faq</h3>
				<p>FAQ</p>

				<ul class="list">
					<li class="active">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
								exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
								Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
								fugiat nulla pariatur.
							</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
								exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
								irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
							</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
								exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
								dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
							</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
								exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
								dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
							</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
								exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
								dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
							</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
				</ul>

				<ul class="list">
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
					<li class="">
						<div class="title">How is SpeedVPN able to speed up my internet?</div>
						<div class="content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</li>
				</ul>
			</div>
		</section>
	</main>

@stop
