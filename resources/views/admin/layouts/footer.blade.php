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
                            <li><a href="{{ url('/how-it-works') }}">How it works</a></li>
                            <li><a href="{{ url('/plans') }}">Plans</a></li>
                            <li><a href="{{ url('/download') }}">Download</a></li>
                            <li><a href="{{ url('/login') }}">Customer's area</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>About</span>
                        <ul>
                            <li><a href="{{ url('/contact-us') }}">Contact us</a></li>
                            <li><a href="{{ url('#') }}">Terms of use</a></li>
                            <li><a href="{{ url('#') }}">Privacy policy</a></li>
                            <li><a href="{{ url('#') }}">FAQ</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>social</span>
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
            <span>Payments methods</span>
            <img src="{{ asset('site/img/payments.png') }}" alt="">
        </div>
    </div>
</footer>
