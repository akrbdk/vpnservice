@extends('admin.layouts._layout')

@section('content')

    <main class="main-painel client-area">
        <div class="container">
            <h2>{{ trans('user_admin.header') }}</h2>

            <div class="table-base clearfix">
                <div class="cover">
                    <img src="{{ asset('site/img/escudo.jpg') }}" alt="">
                </div>

                <div class="content clearfix">
                    <span class="title">{{ trans('user_admin.subscription') }}</span>
                    <div class="left">
                        {{ trans('user_admin.plan_header') }}
                        <span>6 Months</span>
                    </div>

                    <div class="right">
                        {{ trans('user_admin.expires_on') }}
                        <span>04/11/2017</span>
                    </div>

                    <br style="clear:both;">

                    <a href="{{ url('/admin/payment-history') }}" class="btn-blue">{{ trans('user_admin.pay_history') }}</a>
                </div>

                <div class="btn-section">
                    <a href="{{ url('/admin/customer-area') }}" class="btn-green">{{ trans('user_admin.upgrade_plan') }}</a>
                </div>
            </div>

            <div class="table-base clearfix">
                <div class="cover">
                    <img src="{{ asset('site/img/login.jpg') }}" alt="">
                </div>

                <div class="content clearfix">
                    <span class="title">{{ trans('user_admin.email') }}</span>

                    <input type="email" name="email" class="email" value="{{ Auth::user()->email }}" readonly>
                </div>

                <div class="btn-section">
                    <a href="{{ url('/admin/change-password') }}" class="btn-orange">{{ trans('user_admin.pwd_change') }}</a>
                </div>
            </div>

            <div class="table-base clearfix">
                <div class="cover">
                    <img src="{{ asset('site/img/cloud.jpg') }}" alt="">
                </div>

                <div class="content clearfix">
                    <span class="title">{{ trans('user_admin.apps') }}</span>

                    <p>{!! trans('user_admin.download_info') !!}</p>
                </div>

                <div class="btn-section">
                    <a href="{{ url('/download') }}" class="btn-orange">{{ trans('user_admin.download') }}</a>
                </div>
            </div>

            <div class="table-base clearfix">
                <div class="cover">
                    <img src="{{ asset('site/img/heart.jpg') }}" alt="">
                </div>

                <div class="content clearfix">
                    {!! trans('user_admin.invite_friend') !!}
                </div>

                <div class="btn-section">
                    <a href="{{ url('/admin/invites') }}" class="btn-orange">{{ trans('user_admin.invite_button') }}</a>
                </div>
            </div>

            <img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
        </div>
    </main>

@stop
