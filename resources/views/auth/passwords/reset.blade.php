@extends('auth.layouts._layout')

@section('content')

    <main class="main-painel contato">
        <div class="container">
            <h2>{{ __('Forgotten your password?') }}</h2>

            <div class="table-base clearfix">
                <form method="POST" action="{{ url('password/reset') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="password-label">
                        <label for="password">{{ __('E-Mail Address') }}</label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="password form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{ $email ?? old('email') }}"
                               required
                               autofocus
                               placeholder="Insert your new password">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="password-label">
                        <label for="password">{{ __('New password') }}</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Insert your new password"
                               required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="password-label">
                        <label for="password2">{{ __('Confirm your new password') }}</label>
                        <input type="password"
                               id="password-confirm"
                               name="password_confirmation"
                               class="password form-control"
                               placeholder="Confirm your new password"
                               required>
                    </div>

                    <br style="clear:both;">
                    <input type="submit" class="btn-orange" value="Confirm your new password">

                </form>
            </div>
        </div>
    </main>

@stop
