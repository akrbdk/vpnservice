
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
                    <a href="{{ url('admin') }}" >{{ trans('menu.admin_panel') }}</a>
                </li>
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
                     @if(Session::get('locale') == 'en')
                        <img src="{{ asset('site/img/eua.jpg') }}" alt="">English (EN)
                    @else
                        <img src="{{ asset('site/img/br.jpg') }}" alt="">Português (BR)
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
                <li>{{ trans('home.ip_info') }}: {{ $ip_info['ip'] }} </li>
                <li>{{ trans('home.location') }} {{ $ip_info['city'] }}, {{ $ip_info['country'] }}</li>
                <li>{{ trans('home.status') }}
                    @if($protect_status)
                        <span style="color: #00ca6d">{{ trans('home.status_part3') }}</span>
                    @else
                        <span>{{ trans('home.status_part2') }}</span>
                    @endif
                </li>
            </ul>

            <a href="{{ url('admin/logout') }}" id="client-login">{{ trans('menu.logout') }}</a>
        </div>
    </div>

</header>
