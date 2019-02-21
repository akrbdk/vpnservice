@extends('site.layouts._layout')

@section('content')
@php
$tab=1;
@endphp
@if (session('alert'))
    <div class="alert modal-content recovery-pw" style="display: block;">
        <h2>{{ session('alert') }}</h2>
        <button type="button" class="modal-close btn-orange">Ok</button>
    </div>
    <div class="modal" style="display: block;"></div>
@endif
    <div class="bg-gray"></div>

    <main class="main-painel finish-plan">
        <div class="container">

            @if ($message = Session::get('success'))
            <div class="w3-panel w3-green w3-display-container">
                <span onclick="this.parentElement.style.display='none'"
                class="w3-button w3-green w3-large w3-display-topright">&times;</span>
                <p>{!! $message !!}</p>
            </div>
            <?php Session::forget('success');?>
            @endif

            @if ($message = Session::get('error'))
            <div class="w3-panel w3-red w3-display-container">
                <span onclick="this.parentElement.style.display='none'"
                class="w3-button w3-red w3-large w3-display-topright">&times;</span>
                <p>{!! $message !!}</p>
            </div>
            <?php Session::forget('error');?>
            @endif
            <div class="title-c clearfix">
                <span class="number">@php echo $tab; $tab+=1;@endphp</span>

                <div class="title-desc">
                    <h2>CHOOSE YOUR PLAN</h2>
                    <p>7-Day Warranty or your Money Back.</p>
                </div>
            </div>

            <form method="POST" id="payment-form">
              <input type="hidden" class="plan_id" name="plan_id" value="">
              {{ csrf_field() }}

              <section id="choose-plan">
                  <div class="container">



                      @include('site.planslist', ['cards' => App\PlansTable::all(), 'isHidden' => App\PlansTable::isHidden()])
                  </div>


                  <?/* plans alert */?>
                  @include('site.textblocks', ['textblock' => App\Http\Controllers\Site\TextblocksController::getTextBlock('plans_attention')])

                  <?/* plans advantage text */?>
                  @include('site.textblocks', ['textblock' => App\Http\Controllers\Site\TextblocksController::getTextBlock('plans_advantage')])

              </section>

              @guest
                <section id="identificacao">
                  <div class="title-c clearfix">
                      <span class="number">@php echo $tab; $tab+=1;@endphp</span>

                      <div class="title-desc">
                          <h2>IDENTIFICATION</h2>
                          <p>We are not going to share any of your information with any third-party.</p>
                      </div>
                  </div>

                  <div class="clearfix">
                      <label for="email">E-MAIL</label>
                      <input type="email" name="email" class="email" placeholder="Type your friend's email" required>
                  </div>

                  <div class="clearfix">
                      <label for="password">PASSWORD</label>
                      <input type="password" class="password" name="password" minlength="6" required>
                      <a href="javascript:void(0);" onclick="modal();">Forgotten your password?</a>
                  </div>
                </section>
              @endguest


              <section id="payment">
                <div class="title-c clearfix">
                    <span class="number">@php echo $tab; $tab+=1;@endphp</span>

                    <div class="title-desc">
                        <h2>Payment</h2>
                        <p>Choose the best payment method for you.</p>
                    </div>
                </div>

                <div class="trial_start">
                  <button name="pay_method" class="submit btn-green" value="trial">Start Trial Now!</button>
                </div>

                <div class="checkout">
                    <div class="cartao-credito payment-item">
                        <span><img src="{{ asset('site/img/planos.jpg') }}" alt="">  credit/debit card</span>

                        <div class="content">
                            <div class="cover">
                                <img src="{{ asset('site/img/cc.jpg') }}" alt="">
                            </div>

                            <span class="payment-errors"></span>

                            <input type="text" name="cardnumber" class="ncartao" placeholder="Número do cartão" data-stripe="number">

                            <input type="text" name="mm" class="mes" placeholder="MM" data-stripe="exp_month">
                            <input type="text" name="yy" class="ano" placeholder="YY" data-stripe="exp_year">
                            <input type="text" name="ccv" class="ccv" placeholder="CCV" data-stripe="cvc">

                            <br style="clear:both;">
                            <p>Every 6 months the plan will be renewed automatically. You can cancel at any time.</p>

                            <div class="total">
                                total: <span class="get_price"></span>
                            </div>
                            <button name="pay_method" class="submit btn-green" value="{{url('/payWithstripe')}}">Pay now</button>

                            <br style="clear:both;">
                            <p class="termos-servico">By proceeding you will agree to the <span> terms of service</span>.
                            </p>
                        </div>
                    </div>

                    <div class="boleto payment-item">
                        <span><img src="{{ asset('site/img/planos.jpg') }}" alt="">  boleto bancário</span>

                        <div class="content">
                            <p>A opção por boleto bancário não permite renovação automática.</p>

                            <div class="cupom">
                                <p>Possuí um cupom? Clique aqui.</p>

                                <!-- <input type="text" name="cupom2" class="cupom2" placeholder="digite um cupom válido"> -->
                            </div>
                            <div class="total">
                                total: <span class="get_price"></span>
                            </div>
                            <a href="{{ url('#') }}" class="btn-green">Pagar Agora</a>

                            <br style="clear:both;">
                            <p class="termos-servico">Ao prosseguir você concordará com os <span> termos de serviçom</span>.
                            </p>
                        </div>
                    </div>

                    <div class="paypal payment-item">
                        <span><img src="{{ asset('site/img/planos.jpg') }}" alt="">  Paypal</span>

                        <div class="content">
                            <div class="cupom">
                                <p>Do you have a discount coupon? Click here.</p>

                                <!-- <input type="text" name="cupom2" class="cupom2" placeholder="digite um cupom válido"> -->
                            </div>
                            <div class="total">
                                total: <span class="get_price"></span>
                            </div>
                              <button name="pay_method" class="submit btn-green" value="{{url('/payWithpaypal')}}">Pay now</button></p>


                            <br style="clear:both;">
                            <p class="termos-servico">By proceeding you agree to the <span> terms of service</span>.</p>
                        </div>
                    </div>

                    <div class="bitcoin payment-item">
                        <span><img src="{{ asset('site/img/planos.jpg') }}" alt="">  Bitcoin</span>

                        <div class="content">
                            <div class="cupom">
                                <p>Do you have a discount coupon? Click here.</p>

                            <div class="total">
                                total: <span class="get_price"></span>
                            </div>
                              <input type="hidden" name="action" value="checkout" />
                              <input type="hidden" class="bitpay" name="data"/>
                              @Auth
                              <input type="hidden" class="posData" name="posData" value="{{Auth::id()}}">
                              @endauth
                              <button name="pay_method" class="submit btn-green" value="https://test.bitpay.com/checkout">Pay now</button>
                            </form>

                            <br style="clear:both;">
                            <p class="termos-servico">By proceeding you agree to the <span> terms of service</span>.</p>
                            </div>
                        </div>
                    </div>
              </div>
            </section>
        </form>
    </main>

@stop
