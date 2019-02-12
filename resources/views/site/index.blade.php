@extends('site.layouts._layout')

@section('content')

    <section id="features">
        <div class="container">
            <ul id="features-list">
                <li>
                    <img src="{{ asset('site/img/privacity.png') }}" alt="Privacidade online">
                    <span class="title">{{ trans('main.utp1') }}</span>
                    <p class="description">
                        {{ trans('main.utp_text1') }}
                    </p>
                </li>
                <li>
                    <img src="{{ asset('site/img/restriction.png') }}" alt="Navegue sem restrições">
                    <span class="title">{{ trans('main.utp2') }}</span>
                    <p class="description">
                        {{ trans('main.utp_text2') }}
                    </p>
                </li>
                <li>
                    <img src="{{ asset('site/img/security.png') }}" alt="proteção na internet">
                    <span class="title">{{ trans('main.utp3') }}</span>
                    <p class="description">
                        {{ trans('main.utp_text3') }}
                    </p>
                </li>
            </ul>
        </div>
    </section>

    <section id="best-service">
        <div class="container">
            {!! trans('main.points_head') !!}

            <ul id="service-list">
                <li>
                    <img src="{{ asset('site/img/support.png') }}" alt="">
                    <p>{!! trans('main.point1') !!}</p>
                </li>
                <li>
                    <img src="{{ asset('site/img/server.png') }}" alt="">
                    <p>{!! trans('main.point2') !!}</p>
                </li>
                <li>
                    <img src="{{ asset('site/img/apps.png') }}" alt="">
                    <p>{!! trans('main.point3') !!}
                        <img width="13" src="{{ asset('site/img/apple.png') }}" alt="">
                        <img width="14" src="{{ asset('site/img/android.png') }}" alt="">
                    </p>
                </li>
                <li>
                    <img src="{{ asset('site/img/security-cripto.png') }}" alt="">
                    <p>{!! trans('main.point4') !!}</p>
                </li>
                <li>
                    <img src="{{ asset('site/img/transfer-unlimited.png') }}" alt="">
                    <p>{!! trans('main.point5') !!}</p>
                </li>
                <li>
                    <img src="{{ asset('site/img/money-back.png') }}" alt="">
                    <p>{!! trans('main.point6') !!}</p>
                </li>
                <li>
                    <img src="{{ asset('site/img/automated-switch.png') }}" alt="">
                    <p>{!! trans('main.point7') !!}</p>
                </li>
                <li>
                    <img src="{{ asset('site/img/no-logs.png') }}" alt="">
                    <p>{!! trans('main.point8') !!}</p>
                </li>
            </ul>

            <img class="bg-bl" src="{{ asset('site/img/bg-bl.png') }}" alt="">
        </div>
    </section>

    <section id="choose-plan">
        <div class="container">
            {!! trans('main.plans_head') !!}
            @include('site.planslist', ['plans' => App\PlansTable::all(), 'isHidden' => App\PlansTable::isHidden()])
        </div>
    </section>

    <section id="country">
        <div class="container">
            {!! trans('main.lang_head') !!}

            @include('site.serverlist', ['servers' => App\ServersTable::index()])
        </div>
    </section>

@stop
