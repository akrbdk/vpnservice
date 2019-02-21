@php
$prices = DB::table('plans_table')->select('id','price','months_limit')->get()->toArray();
@endphp
<ul id="plan-list" class="clearfix">
  @foreach($cards as $card)
  @php
    $plans = json_decode($card->plans, true);
    for($i = 0; $i < count($plans); $i++) {
      $find = array_search($plans[$i]['plan_id'], array_column($prices, 'id'));
      $plans[$i]['price'] = $prices[$find]->price;
      $plans[$i]['duration'] = $prices[$find]->months_limit;
    }
  @endphp
  <li class="most-pop card">
      <div class="title">{{ trans($card->title) }}</div>
      <div class="price">
          <span class="currency">$</span>
          <span class="coin"><?= number_format(($plans[0]['price']/100), 2, '.', '') ?></span></span>
      </div>
      <div class="plan-type">
          Per month
      </div>

      <ul class="feature-list">
        {!! trans($card->advantages) !!}
      </ul>

      <select>
        @foreach ($plans as $plan)
          <option plan_id='{{$plan["plan_id"]}}' price='{{$plan["price"]}}' duration='{{$plan["duration"]/30/24/60/60}}'>{{ trans($plan["text"]) }}</option>
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
        <a href="{{ url('plans') }}" class="btn-{{ $card->btn_color }}"> {{ trans($card->button) }} </a>
      @endif
  </li>
  @endforeach
</ul>
