@extends('admin.layouts._layout')

@section('content')

    <main class="main-painel client-area">
        <div class="container">
            <h2>Customer's area</h2>

            <div class="table-base clearfix">
                <div class="cover">
                    <img src="{{ asset('site/img/escudo.jpg') }}" alt="">
                </div>

                <div class="content clearfix">
                    <span class="title">Your subscription</span>
                    <div class="left">
                        YOUR PLAN
                        <span>6 Months</span>
                    </div>

                    <div class="right">
                        EXPIRES ON
                        <span>04/11/2017</span>
                    </div>

                    <br style="clear:both;">

                    <a href="{{ url('/admin/payment-history') }}" class="btn-blue">Payments history</a>
                </div>

                <div class="btn-section">
                    <a href="{{ url('admin/customer-area') }}" class="btn-green">UPGRADE</a>
                </div>
            </div>

            <div class="table-base clearfix">
                <div class="cover">
                    <img src="{{ asset('site/img/login.jpg') }}" alt="">
                </div>

                <div class="content clearfix">
                    <span class="title">Your login</span>

                    <input type="email" name="email" class="email" value="nome@email.com.br" readonly>
                </div>

                <div class="btn-section">
                    <a href="{{ url('/admin/change-password') }}" class="btn-orange">CHANGE PASSWORD</a>
                </div>
            </div>

            <div class="table-base clearfix">
                <div class="cover">
                    <img src="{{ asset('site/img/cloud.jpg') }}" alt="">
                </div>

                <div class="content clearfix">
                    <span class="title">Apps</span>

                    <p>Download the latest version<br />SpeedVPN Version: 1.0</p>
                </div>

                <div class="btn-section">
                    <a href="{{ url('/download') }}" class="btn-orange">download</a>
                </div>
            </div>

            <div class="table-base clearfix">
                <div class="cover">
                    <img src="{{ asset('site/img/heart.jpg') }}" alt="">
                </div>

                <div class="content clearfix">
                    <span class="title">Invite a friend</span>

                    <p>You and your friend gets one month<br />free if your friend register :D</p>
                </div>

                <div class="btn-section">
                    <a href="{{ url('/admin/invites') }}" class="btn-orange">Invite</a>
                </div>
            </div>

            <img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
        </div>
    </main>

@stop
