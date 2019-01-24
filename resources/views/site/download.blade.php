@extends('site.layouts._layout')

@section('content')

	<main id="main" class="download">
		<div class="download-banner">
			<div class="container">
				<div class="right">
					<h2>Download</h2>
					<span>SpeedVPN for Windows</span>

					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
						eiusmod tempor incididunt ut labore et dolore magna aliqua.
					</p>
					<p>SpeedVPN Version: 1.0</p>

					<a href="{{ url('/download') }}" class="btn-green">Download</a>
				</div>
			</div>
		</div>

		<section class="download-nav">
			<div class="container">
				<ul class="list">
					<li class="active">
                        <a href="{{ url('/download/windows/') }}">Windows</a>
                    </li>
					<li><a href="{{ url('/download/mac/') }}">MAC</a></li>
					<li><a href="{{ url('/download/android/') }}">Android</a></li>
					<li><a href="{{ url('/download/ios/') }}">iOS</a></li>
				</ul>
			</div>
		</section>

		<section id="use-steps">
			<div class="container">
				<h3>Easy to use</h3>

				<div class="steps">
					<ul>
						<li>
							<div class="center">
								<img src="{{ asset('site/img/cloud-use.png') }}" alt="">
							</div>
							<p>Download and install the application for your device.</p>
						</li>
						<li>
							<div class="center">
								<img src="{{ asset('site/img/choose.png') }}" alt="">
							</div>
							<p>Choose the automatic server or choose one of your preference.</p>
						</li>
						<li>
							<div class="center">
								<img src="{{ asset('site/img/lock-use.png') }}" alt="">
							</div>
							<p>Protection to browse freely on the internet.</p>
						</li>
					</ul>
				</div>
			</div>
		</section>
	</main>

@stop
