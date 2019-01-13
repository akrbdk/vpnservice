
<!--[if lt IE 7]>
<p class="browsehappy">Você está usando um navegador <strong>desatualizado</strong>. Por favor, <a
        href="http://browsehappy.com/">atualize seu navegador</a>.</p>
<![endif]-->

<header id="header" class="home-page">
    <div class="container">
        <h1 class="logo">
            <a href="{{ url('/') }}">
                SpeedVPN
            </a>
        </h1>

        <nav id="menu">
            <ul class="menu-header">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="{{ url('/how-it-works') }}">How it works_</a>
                </li>
                <li>
                    <a href="{{ url('/plans') }}">Plans</a>
                </li>
                <li>
                    <a href="{{ url('/download') }}">Download</a>
                </li>
                <li class="free-test">
                    <a href="{{ url('/plans') }}">Test it free</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="visitor">
        <div class="container">
            <nav id="visitor-lang">
					<span class="lag-active">
                        <img src="{{ asset('site/img/br.jpg') }}" alt="">Português (BR)
						<ul>
							<li rel="portugues2"><img src="{{ asset('site/img/br.jpg') }}" alt="">Português (BR)</li>
							<li rel="portugues3"><img src="{{ asset('site/img/eua.jpg') }}" alt="">English (EN)</li>
						</ul>
					</span>
            </nav>

            <ul id="visitor-info">
                <li>Your IP: 168.192.0.1</li>
                <li>Location: Blumenau, Brazil</li>
                <li>You are: <span>Unprotected</span></li>
            </ul>

            @if(Auth::user())
                <a href="{{ url('logout') }}" id="client-login">Logout</a>
            @else
                <a href="{{ route('login') }}" id="client-login">Customer's area</a>
            @endif

        </div>
    </div>
</header>
