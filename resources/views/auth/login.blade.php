@extends('auth.layouts._layout')

@section('content')
<div id='sendmessage' style='display:none'>
  <div class="alert-success modal-content recovery-pw" style="display: block;">
      <h2 class='errtext'>Email wasn't send</h2>
      <button type="button" class="modal-close btn-green">Ok</button>
  </div>
  <div class="modal" style="display: block;"></div>
</div>

    <main class="main-painel login-area">

        <div class="container">
            <h2>{{ trans('auth.area_name') }}</h2>
            <div class="table-base clearfix">
                <form class="clearfix" method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="clearfix">
                        <label for="email">{{ trans('auth.email') }}</label>
                        <input type="email"
                               name="email"
                               class="email{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               placeholder="{{ trans('auth.email_line') }}"
                               value="{{ old('email') }}"
                               required
                               autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="clearfix">
                        <label for="password">{{ trans('auth.password') }}</label>
                        <input type="password" class="password{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <a href="javascript:void(0);" onclick="modal();">{{ trans('auth.forgotten_pass') }}</a>
                    </div>
                    <div class="clearfix">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="clearfix">
                        <div class="g-recaptcha" data-sitekey="6LfKh4IUAAAAAGA3yo7qkblWIFXg3_WUGXJTuovW"
                             data-callback="someFunctionName"></div>
                        <script>function someFunctionName() {
                                $('#button1').removeAttr('disabled');
                            }</script>
                    </div>
                    <input disabled="disabled" type="submit" class="btn-orange" value="{{ trans('auth.login') }}"
                           id="button1">
                    <p></p>
                </form>
                <p style="text-align: center">{{ trans('auth.question') }}
                    <a href="{{ url('/register') }}">
                        <span>{{ trans('auth.register') }}</span>
                    </a>
                </p>
                <p style="text-align: center">
                    {{ trans('auth.question3') }}
                    <a href="{{ url('/plans') }}">
                        <span>{{ trans('auth.choose_plan') }}</span>
                    </a>
                    {{ trans('auth.text1') }}<br/>
                    <a href="{{ url('/plans') }}">
                        <span>{{ trans('auth.free_test') }}</span>
                        <a>
                </p>
            </div>

            <img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
        </div>
    </main>

@stop
