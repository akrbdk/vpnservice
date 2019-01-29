<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" itemscope itemtype="http://schema.org/Article">
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="" prefix="og: http://ogp.me/ns#" itemscope itemtype="http://schema.org/Article">
<!--<![endif]-->
<head>
    <title>{{ 'Speed VPN' }}</title>
    <meta name="description" content="{{ (isset($meta_desc)) ? $meta_desc : ''}}">
    <meta name="keywords" content="{{ (isset($keywords)) ? $keywords : ''}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Tags básicas -->
    <meta charset="utf-8">
    <meta name="language" content="pt-BR">
    <meta name="robots" content="index,follow"/>
    <meta name="url" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">
    <meta http-equiv="Cache-Control" content="no-cache">

    <!-- Humans -->
    <link rel="icon" href="./img/icons/favicon.ico">
    <link type="text/plain" rel="author" href="/humans.txt"/>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="">

    <!-- IE -->
    <meta name="msapplication-config" content="/browserconfig.xml"/>
    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- Apple -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="">
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon.png">
    <link rel="apple-touch-startup-image" href="/apple-startup.png">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
    <link rel="icon" sizes="192x192" href="/chrome-touch-icon-192x192.png">
    <link rel="shortcut icon" href="/apple-touch-icon.png">

    <!-- Android Chrome icon -->
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Android Lolipop Theme Color -->
    <meta name="theme-color" content="#333333">

    <!-- SEO: Se a url das páginas mobile forem diferentes, adicione a canonical url da página normal. https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--<link rel="canonical" href="">-->

    <!-- Schema.org Google+ -->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="">
    <link rel="author" href=""/>
    <link rel="publisher" href=""/>

    <!-- OpenGraph -->
    <meta property="og:site_name" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:image:width" content=""/>
    <meta property="og:image:height" content=""/>
    <meta property="og:description" content=""/>

    <!-- Twitter Card -->
    <meta name="twitter:card" content="">
    <meta name="twitter:site" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image" content="">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
<!--[if lt IE 7]>
<p class="browsehappy">Você está usando um navegador <strong>desatualizado</strong>. Por favor, <a
    href="http://browsehappy.com/">atualize seu navegador</a>.</p>
<![endif]-->

<header id="header" class="home-page">
    <div class="container">
        <h1 class="logo">
            <a href="localhost:8000/">
                SpeedVPN
            </a>
        </h1>

        <nav id="menu">
            <ul class="menu-header">
                <li><a href="/">Home</a></li>
                <li><a href="/how-it-works">How it works</a></li>
                <li><a href="/plans">Plans</a></li>
                <li><a href="/download">Download</a></li>
                <li class="free-test"><a href="/plans">Test it free</a></li>
            </ul>
        </nav>
    </div>
    <div class="visitor">
        <div class="container">
            <nav id="visitor-lang">
					<span class="lag-active"><img src="./img/br.jpg" alt="">Português (BR)
						<ul>
							<li rel="portugues2"><img src="./img/br.jpg" alt="">Português (BR)</li>
							<li rel="portugues3"><img src="./img/eua.jpg" alt="">English (EN)</li>
						</ul>
					</span>
            </nav>

            <ul id="visitor-info">
                <li>Your IP: 168.192.0.1</li>
                <li>Location: Blumenau, Brazil</li>
                <li>You are: <span>Unprotected</span></li>
            </ul>

            <a href="{{ route('login') }}" id="client-login">Customer's area</a>
        </div>
    </div>

    @if(Route::currentRouteName() == 'home' || Route::currentRouteName() == '/')

        <div id="banner">
            <div class="banner-slide" style="background: url(./img/banner-home.png) no-repeat center top; background-size: cover;">
                <div class="container">
                    <div class="content">
                        <h3 style="color: #004f8f">Fast and secure</h3>
                        <span style="color: #004f8f">The most intelligent and easiest VPN to use.</span>
                        <a href="/plans" class="btn-orange">Test 3 days free</a>
                        <a href="/plans" class="btn-green">Subscribe</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</header>

<?/* content
<section id="features">
    <div class="container">
        <ul id="features-list">
            <li>
                <img src="./img/privacity.png" alt="Privacidade online">
                <span class="title">Online privacy</span>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </li>
            <li>
                <img src="./img/restriction.png" alt="Navegue sem restrições">
                <span class="title">Browse freely</span>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </li>
            <li>
                <img src="./img/security.png" alt="proteção na internet">
                <span class="title">Internet protection</span>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </li>
        </ul>
    </div>
</section>
<section id="best-service">
    <div class="container">
        <h3 class="title">THE BEST VPN SERVICE</h3>
        <span class="subtitle">Some of the advantages for using the fastest and the most secure VPN</span>

        <ul id="service-list">
            <li><img src="./img/support.png" alt=""> <p>Support 24 hours a day <br />7 days a week.</p></li>
            <li><img src="./img/server.png" alt=""> <p>Ultra fast in more than x countries.</p></li>
            <li><img src="./img/apps.png" alt=""> <p>Windows application <br />Soon: <img width="13" src="./img/apple.png" alt=""> <img width="14" src="./img/android.png" alt=""></p></li>
            <li><img src="./img/security-cripto.png" alt=""> <p>The best in security and encryption.</p></li>
            <li><img src="./img/transfer-unlimited.png" alt=""> <p>Unlmited traffic and servers exchanges.</p></li>
            <li><img src="./img/money-back.png" alt=""> <p>Guaranteed refund <br />(7 days).</p></li>
            <li><img src="./img/automated-switch.png" alt=""> <p>Automatic Kill Switch.</p></li>
            <li><img src="./img/no-logs.png" alt=""> <p>Don't save your logs.</p></li>
        </ul>

        <img class="bg-bl" src="./img/bg-bl.png" alt="">
    </div>
</section>
<section id="choose-plan">
    <div class="container">
        <h2>Choose your plan</h2>

        <ul id="plan-list">
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
                    <li>Without any disconnects every minute</li>
                    <li>Normal speed</li>
                </ul>

                <span class="trial">3 days free</span>
                <a href="/plans" class="btn-orange">test 3 days free</a>
            </li>
            <li class="plan-basic">
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

                <a href="/plans" class="btn-green">Subscribe now</a>
            </li>
            <li class="most-pop">
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
                    <li>More than 100 server</li>
                    <li>High speed connection</li>
                    <li>Premium support</li>
                </ul>

                <select name="plan-period" id="plan-period">
                    <option value="anual">Anual - 54% of discount</option>
                    <option value="anual">Anual - 54% of discount</option>
                    <option value="anual">Anual - 54% of discount</option>
                </select>

                <a href="/plans" class="btn-green">Subscribe now</a>
            </li>
        </ul>
    </div>
</section>
<section id="country">
    <div class="container">
        <h2>More than 40 countries, more than 100 servers</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

        <span class="title">Number of servers per country:</span>

        <ul id="country-list">
            <li>
                <img src="./img/flag-1.png" alt="">
                <span>3</span>

                <div class="cities">
                    <p>São Paulo - SP</p>
                    <p>Rio de Janeiro - RJ</p>
                    <p>Porto Alegre - RS</p>
                </div>
            </li>
            <li><img src="./img/flag-2.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-3.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-4.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-5.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-6.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-7.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-8.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-9.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-10.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-11.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-12.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-13.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-14.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-15.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-16.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-17.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-18.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-19.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-20.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-21.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-22.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-23.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-24.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-25.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-26.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-27.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-28.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-29.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-30.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-31.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-32.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-33.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-34.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-35.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-36.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-37.png" alt=""><span>3</span></li>
            <li><img src="./img/flag-38.png" alt=""><span>3</span></li>
            <li>and counting...</li>
        </ul>
    </div>
</section>
*/?>

<?/* footer */?>
@yield('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="./js/vendor.min.js"></script>
<script src="./js/main.min.js"></script>

<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='http://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X');ga('send','pageview');
</script>
</body>
</html>

