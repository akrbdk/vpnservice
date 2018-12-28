<footer id="footer">
    <div class="container">
        <div class="logo-base">
            <h3 class="logo"><a href="{{ url('/') }}">SpeedVPN</a></h3>
            <span>Copyright © 2018 SpeedVPN</span>
        </div>

        <div class="menu-base">
            <nav id="menu-footer">
                <ul>
                    <li>
                        <span>speedVPN</span>
                        <ul>
                            <li><a href="{{ url('/how-it-works') }}">{{ trans('menu.how') }}</a></li>
                            <li><a href="{{ url('/plans') }}">{{ trans('menu.plans') }}</a></li>
                            <li><a href="{{ url('/download') }}">{{ trans('menu.download') }}</a></li>
                            <li><a href="{{ url('/login') }}">{{ trans('menu.login') }}</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>{{ trans('menu.about') }}</span>
                        <ul>
                            <li><a href="{{ url('/contact-us') }}">{{ trans('menu.contact') }}</a></li>
                            <li><a href="{{ url('#') }}">{{ trans('menu.terms') }}</a></li>
                            <li><a href="{{ url('#') }}">{{ trans('menu.privacy') }}</a></li>
                            <li><a href="{{ url('#') }}">{{ trans('menu.faq') }}</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>{{ trans('menu.social') }}</span>
                        <ul>
                            <li>
                                <a href="http://www.facebook.com">
                                    <img src="{{ asset('site/img/facebook.png') }}" alt="Facebook">Facebook
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="payments-base">
            <span>{{ trans('menu.payments_methods') }}</span>
            <img src="{{ asset('site/img/payments.png') }}" alt="">
        </div>
    </div>
</footer>
