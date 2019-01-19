@extends('admin.layouts._layout')

@section('content')

    <main class="main-painel contato">
        <div class="container">
            <h2>{{ __('Forgotten your password?') }}</h2>

            <div class="table-base clearfix">

                <form method="POST" action="{{ url('/admin/new-password') }}">
                    @csrf

                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                    <div class="password-label">
                        <label for="password">{{ __('Current password') }}</label>
                        @if ($errors->has('current_password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                        @endif
                        <input type="password"
                               name="current_password"
                               id="password"
                               class="password form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                               placeholder="Insert your current password"
                               required>
                    </div>

                    <div class="password-label">
                        <label for="password">{{ __('New password') }}</label>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <input type="password"
                               name="password"
                               id="password"
                               class="password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Insert your new password"
                               required>
                    </div>

                    <div class="password-label">
                        <label for="password2">{{ __('Confirm your new password') }}</label>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
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
