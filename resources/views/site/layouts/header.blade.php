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
                @if(Auth::check())
                    <li>
                        <a href="{{ url('admin') }}">{{ trans('menu.admin_panel') }}</a>
                    </li>
                @endif
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

            @if(Auth::check())
                <a href="{{ url('admin/logout') }}" id="client-login">{{ trans('menu.logout') }}</a>
            @else
                <a href="{{ route('login') }}" id="client-login">{{ trans('home.enter_button') }}</a>
            @endif

        </div>
    </div>


    @if(Request::path() == 'home' || Request::path() == '/')

        <div id="banner">
            <div class="banner-slide"
                 style="background: url({{ asset('site/img/banner-home.png') }}) no-repeat center top; background-size: cover;">
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

<!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5c39db49494cc76b7872c03a/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <!--Start of tawk.to Status Code-->

    <script type="text/javascript">
        Tawk_API = Tawk_API || {};
        Tawk_API.onStatusChange = function (status) {
            if (status === 'online') {
                document.getElementById('status').innerHTML = '<p class="chat-status online">online</p>';
            }
            else if (status === 'away') {
                document.getElementById('status').innerHTML = '<p class="chat-status offline">We are currently away</p>';
            }
            else if (status === 'offline') {
                document.getElementById('status').innerHTML = '<p class="chat-status offline">offline</p>';
            }
        };
    </script>

    <!--End of tawk.to Status Code -->
</header>
