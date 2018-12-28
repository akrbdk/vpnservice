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
            <ul id="plan-list">
                <li class="plan-free">
                    <div class="title">Free</div>
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="coin">0</span>
                        <span class="cents">.00</span>
                    </div>
                    <div class="plan-type">
                        Per month
                    </div>

                    <ul class="feature-list">
                        {!! trans('main.plan1') !!}
                    </ul>

                    <span class="trial">3 days free</span>
                    <a href="{{ url('/plans') }}" class="btn-orange">test 3 days free</a>
                </li>

                <li class="plan-basic">
                    <div class="title">Basic</div>
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="coin">4</span>
                        <span class="cents">.90</span>
                    </div>
                    <div class="plan-type">
                        Per month
                    </div>

                    <ul class="feature-list">
                        {!! trans('main.plan2') !!}
                    </ul>

                    <select name="plan-period" id="plan-period">
                        <option value="anual">Anual - 51% of discount</option>
                        <option value="anual">Anual - 51% of discount</option>
                        <option value="anual">Anual - 51% of discount</option>
                    </select>

                    <a href="{{ url('/plans') }}" class="btn-green">Subscribe now</a>
                </li>
                <li class="most-pop">
                    <div class="title">
                        <span>The most popular</span>
                        Prime
                    </div>
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="coin">6</span>
                        <span class="cents">.90</span>
                    </div>
                    <div class="plan-type">
                        Per month
                    </div>

                    <ul class="feature-list">
                        {!! trans('main.plan3') !!}
                    </ul>

                    <select name="plan-period" id="plan-period">
                        <option value="anual">Anual - 54% of discount</option>
                        <option value="anual">Anual - 54% of discount</option>
                        <option value="anual">Anual - 54% of discount</option>
                    </select>

                    <a href="{{ url('/plans') }}" class="btn-green">Subscribe now</a>
                </li>
            </ul>
        </div>
    </section>

    <section id="country">
        <div class="container">
            {!! trans('main.lang_head') !!}

            <ul id="country-list">
                <li>
                    <img src="{{ asset('site/img/flag-1.png') }}" alt="">
                    <span>3</span>

                    <div class="cities">
                        <p>São Paulo - SP</p>
                        <p>Rio de Janeiro - RJ</p>
                        <p>Porto Alegre - RS</p>
                    </div>
                </li>
                <li><img src="{{ asset('site/img/flag-2.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-3.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-4.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-5.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-6.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-7.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-8.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-9.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-10.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-11.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-12.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-13.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-14.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-15.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-16.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-17.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-18.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-19.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-20.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-21.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-22.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-23.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-24.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-25.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-26.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-27.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-28.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-29.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-30.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-31.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-32.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-33.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-34.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-35.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-36.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-37.png') }}" alt=""><span>3</span></li>
                <li><img src="{{ asset('site/img/flag-38.png') }}" alt=""><span>3</span></li>
                <li>and counting...</li>
            </ul>
        </div>
    </section>

@stop
