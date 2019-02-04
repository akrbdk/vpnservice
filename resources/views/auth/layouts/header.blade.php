<!--[if lt IE 7]>
<p class="browsehappy">
    Você está usando um navegador
    <strong>desatualizado</strong>. Por favor,
    <a href="http://browsehappy.com/">atualize seu navegador</a>.
</p>
<![endif]-->


<div class="modal-content recovery-pw">
    <h2>{{ trans('auth.forgotten_pass') }}</h2>
    <form id="reset_email_submit" class="clearfix" method="POST" action="">
        {{ csrf_field() }}

        <div class="clearfix reset_email">
            <label for="email">{{ trans('auth.email') }}</label>
            <input type="email" class="email" placeholder="{{ trans('auth.email_inform') }}" name="email"
                   value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <input type="submit" class="btn-orange" value="{{ trans('auth.submit_email') }}">
    </form>
</div>
<div class="modal"></div>

<header id="header-painel">
    <h1 class="logo">
        <a href="{{ url('/') }}">
            SpeedVPN
        </a>
    </h1>

    <nav id="menu">
        <ul class="menu-header">
            <li><a href="{{ url('/payment-history') }}">{{ trans('menu.payments') }}</a></li>
            <li><a href="{{ url('/invites') }}">{{ trans('menu.invitations') }}</a></li>
            <li><a href="{{ url('/download') }}">{{ trans('menu.download') }}</a></li>
            <li><a href="{{ url('/contact-us') }}">{{ trans('menu.contact') }}</a></li>
            <li><a href="{{ url('/') }}">{{ trans('menu.leave') }}</a></li>
        </ul>
    </nav>
</header>
