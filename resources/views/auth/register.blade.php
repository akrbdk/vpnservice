@extends('auth.layouts._layout')

@section('content')

    <main class="main-painel login-area">
        <div class="container">
            <h2>{{ trans('auth.register') }}</h2>

            <div class="table-base clearfix">
                <form class="clearfix" method="post" action="{{ url('register') }}">

                    @csrf

                    <div class="clearfix">
                        <label for="name">{{trans('auth.name') }}</label>
                        <input type="text"
                               name="name"
                               class="email {{ $errors->has('name') ? ' is-invalid' : '' }}"
                               placeholder="{{trans('auth.name_line') }}"
                               value="{{ old('name') }}"
                               required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="clearfix">
                        <label for="email">{{ trans('auth.email') }}</label>
                        <input type="email"
                               name="email"
                               class="email {{ $errors->has('email') ? ' is-invalid' : '' }}"
                               placeholder="{{ trans('auth.email_line') }}"
                               value="{{ old('email') }}" r
                               equired>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>

                    <div class="clearfix">
                        <label for="password">{{ trans('auth.password') }}</label>
                        <input type="password" class="password {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="clearfix">
                        <label for="password-confirm">{{ trans('auth.password_confirm') }}</label>
                        <input id="password-confirm" type="password" class="password" name="password_confirmation">
                        <a href="javascript:void(0);" onclick="modal();">{{ trans('auth.forgotten_pass') }}</a>
                    </div>

                    <div class="clearfix">
                        <div class="g-recaptcha" data-sitekey="6LfKh4IUAAAAAGA3yo7qkblWIFXg3_WUGXJTuovW"
                             data-callback="someFunctionName"></div>
                        <script>function someFunctionName() {
                                $('#button1').removeAttr('disabled');
                            }</script>
                    </div>

                    <input disabled="disabled" type="submit" id="button1" class="btn-orange"
                           value="{{ trans('auth.register') }}">
                    <p></p>
                </form>

                <p style="text-align: center">{{ trans('auth.question2') }} <a
                        href="{{ url('/login') }}"><span>{{ trans('auth.login') }}</span></a></p>

                <p style="text-align: center">
                    {{ trans('auth.question3') }}
                    <a href="{{ url('/plans') }}"><span>{{ trans('auth.choose_plan') }}</span></a>
                    {{ trans('auth.text1') }}<br/>
                    <a href="{{ url('/plans') }}"><span>{{ trans('auth.free_test') }}</span><a>
                </p>
            </div>
            <img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
        </div>
    </main>

@stop
