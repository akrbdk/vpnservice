<ul id="plan-list" class="clearfix">
 @foreach($cards as $card)
        <li class="most-pop card">
            <div class="title">{{ trans($card->title) }}</div>
            <div class="price">
                <span class="currency">$</span>
                <span class="coin"><?= number_format(($card->main_price/100), 2, '<span class="cents">.', '') ?></span></span>
            </div>
            <div class="plan-type">
                Per month
            </div>

            <ul class="feature-list">
              {!! trans($card->advantages) !!}
            </ul>

            <select>
              @php
              $plans = json_decode($card->plans, true);

              @endphp

              @foreach ($plans as $plan)
                <option plan_id='{{$plan["plan_id"]}}' price='{{$plan["price"]}}'>{{ trans($plan["text"]) }}</option>
              @endforeach
            </select>
            @if (Request::path() === 'plans')
              <label for="{{$card->id}}" class="btn-{{ $card->btn_color }} button-label {{ $card->title }}"
                @if ( $card->id === 1)
                {{ $isHidden }}
                @endif
              >
              <h1>{{ trans($card->button) }}</h1>
              </label>
            @endif
            @if (Request::path() === '/')
              <a href="{{ url('plans') }}" class="btn-{{ $card->btn_color }}"> {{ $card->button }} </a>
            @endif
        </li>
  @endforeach
</ul>
