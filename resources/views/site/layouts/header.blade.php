
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
                    <a href="{{ url('/') }}">{{ trans('menu.home') }}</a>
                </li>
                <li>
                    <a href="{{ url('/how-it-works') }}">{{ trans('menu.how') }}</a>
                </li>
                <li>
                    <a href="{{ url('/plans') }}">{{ trans('menu.plans') }}</a>
                </li>
                <li>
                    <a href="{{ url('/download') }}">{{ trans('menu.download') }}</a>
                </li>
                <li class="free-test">
                    <a href="{{ url('/plans') }}">{{ trans('menu.testIt') }}</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="visitor">
        <div class="container">
            <nav id="visitor-lang">
					<span class="lag-active">
                         @if(Session::get('locale') == 'br')
                            <img src="{{ asset('site/img/br.jpg') }}" alt="">Português (BR)
                         @else
                            <img src="{{ asset('site/img/eua.jpg') }}" alt="">English (EN)
                         @endif
						<ul>
							<li rel="portugues2">
                                <a href="<?= route('setlocale', ['lang' => 'br']) ?>">
                                    <img src="{{ asset('site/img/br.jpg') }}" alt="">Português (BR)
                                </a>
                            </li>
							<li rel="portugues3">
                                <a href="<?= route('setlocale', ['lang' => 'en']) ?>">
                                    <img src="{{ asset('site/img/eua.jpg') }}" alt="">English (EN)
                                </a>
                            </li>
						</ul>



					</span>
            </nav>

            <ul id="visitor-info">
                <li>{{ trans('home.ip_info') }}: 168.192.0.1 </li>
                <li>{{ trans('home.location') }}</li>
                <li>{{ trans('home.status') }} <span>{{ trans('home.status_part2') }}</span></li>
            </ul>

            @if(Auth::check() && Request::path() == 'admin')
                <a href="{{ url('logout') }}" id="client-login">Logout</a>
            @endif
            @if(Request::path() != 'admin')
                <a href="{{ route('login') }}" id="client-login">{{ trans('home.enter_button') }}</a>
            @endif
        </div>
    </div>


    @if(Request::path() == 'home' || Request::path() == '/')

        <div id="banner">
            <div class="banner-slide" style="background: url({{ asset('site/img/banner-home.png') }}) no-repeat center top; background-size: cover;">
                <div class="container">
                    <div class="content">
                        <h3 style="color: #004f8f">{{ trans('home.header_text') }}</h3>
                        <span style="color: #004f8f">{{ trans('home.header_text1') }}</span>
                        <a href="{{ url('/plans') }}" class="btn-orange">{{ trans('home.header_text2') }}</a>
                        <a href="{{ url('/plans') }}" class="btn-green">{{ trans('home.header_text3') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</header>
