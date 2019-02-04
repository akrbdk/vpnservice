@extends('site.layouts._layout')

@section('content')

    <main id="main" class="como-funciona">
        <section class="pro-con">
            <div class="container">
                <h2>How it works</h2>

                <div class="without-speedvpn">
                    <h3 class="title">Without speedvpn</h3>

                    <ul class="list">
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/seu-ip-red.jpg') }}" alt="">
                            </div>
                            <p>Your IP:<br/>168.192.100.255</p>
                        </li>
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/separacao-esq-red.jpg') }}" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/expostos.jpg') }}" alt="">
                            </div>
                            <p>Your data is <span> exposed!</span></p>
                        </li>
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/separacao-dir-red.jpg') }}" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/internet-red.jpg') }}" alt="">
                            </div>
                            <p>Internet:<br/>168.192.100.255</p>
                        </li>
                    </ul>
                </div>
                <div class="with-speedvpn">
                    <h3 class="title">with speedvpn</h3>

                    <ul class="list">
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/como-funciona_15.jpg') }}" alt="">
                            </div>
                            <p>Your IP:<br/>168.192.100.255</p>
                        </li>
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/separacao-esq.jpg') }}" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/criptografados-verde.jpg') }}" alt="">
                            </div>
                            <p>Your data is <span>encrypted</span></p>
                        </li>
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/separacao-esq.jpg') }}" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="cover">
                                <img src="{{ asset('site/img/internet-azul.jpg') }}" alt="">
                            </div>
                            <p>Internet:<br/>48.110.10.145</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="about-vpn">
            <p>A paragraph explaining how the VPN works..</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt<br/>
                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation<br/>
                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </section>

        <div class="container">
            <section id="services">
                <h3>The best VPN service</h3>
                <p>Some advantages for choosing the fatest and most secure VPN</p>

                <ul class="list">
                    <li>
                        <div class="cover">
                            <img src="{{ asset('site/img/suporte.jpg') }}" alt="">
                        </div>
                        <p>24 hours support 7 days a week.</p>
                    </li>
                    <li>
                        <div class="cover">
                            <img src="{{ asset('site/img/servidor-ultra.jpg') }}" alt="">
                        </div>
                        <p>Ultra fast servers in more than X countries.</p>
                    </li>
                    <li>
                        <div class="cover">
                            <img src="{{ asset('site/img/trafego.jpg') }}" alt="">
                        </div>
                        <p>Unlimited traffic and servers exchanges.</p>
                    </li>
                    <li>
                        <div class="cover">
                            <img src="{{ asset('site/img/garantia.jpg') }}" alt="">
                        </div>
                        <p>Refund guaranteed (7 days).</p>
                    </li>
                    <li>
                        <div class="cover">
                            <img src="{{ asset('site/img/app-win.jpg') }}" alt="">
                        </div>
                        <p>Windows aplications soon: <img src="{{ asset('site/img/apple-gray.jpg') }}" alt=""> <img
                                src="{{ asset('site/img/android-gray.jpg') }}" alt=""></p>
                    </li>
                    <li>
                        <div class="cover">
                            <img src="{{ asset('site/img/seguranca-cripto.jpg') }}" alt="">
                        </div>
                        <p>The best in security and encryption.</p>
                    </li>
                    <li>
                        <div class="cover">
                            <img src="{{ asset('site/img/kill-switch.jpg') }}" alt="">
                        </div>
                        <p>Automatic Kill Switch.</p>
                    </li>
                    <li>
                        <div class="cover">
                            <img src="{{ asset('site/img/registros.jpg') }}" alt="">
                        </div>
                        <p>Don't save your logs.</p>
                    </li>
                </ul>
            </section>

            <section id="u-infos">
                <h3>YOUR INFORMATION</h3>
                <p>Some of your informations that is exposed</p>

                <ul class="list">
                    <li>Your IP: <span>168.192.100.255</span></li>
                    <li>Your ISP provider: <span>NET Virtua</span></li>
                    <li>Location: <span>Blumenau</span></li>
                    <li>Country: <span>Brazil</span></li>
                    <li>Operational system: <span>Windows 10</span></li>
                    <li>Screen resolution: <span>1920x1080</span></li>
                    <li>Browser: <span>Firefox</span></li>
                </ul>
            </section>

            <br style="clear:both;">
            <a href="{{ url('/plans') }}" class="btn-green">I want to use SpeedVPN</a>
        </div>

    </main>

@stop
