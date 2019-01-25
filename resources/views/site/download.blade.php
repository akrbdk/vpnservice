@extends('site.layouts._layout')

@section('content')

	<main id="main" class="download">
		<div class="download-banner">
			<div class="container">
				<div class="right">
					<h2>{{ $tabInfo->header }}</h2>
                    {!! $tabInfo->content !!}
					<p>SpeedVPN Version: {{ $tabInfo->version }}</p>
					<a href="{{ $tabInfo->link_install }}" class="btn-green">{{ $tabInfo->button_text }}</a>
				</div>
			</div>
		</div>

		<section class="download-nav">
			<div class="container">
				<ul class="list">
                    @foreach ($allTabs as $tab)
                        <li class="@if ($tabInfo->link == $tab->link) active @endif">
                            <a href="/download/{{ $tab->link }}/">{{ $tab->link_text }}</a>
                        </li>
                    @endforeach
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
