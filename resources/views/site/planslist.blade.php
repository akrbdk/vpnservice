@php
$basic ='';
$advanced='';
$premium='';
foreach ($plans as $plan){
  if($plan->plan_name === 'Basic'){
    $basic .='<option value='.$plan->id.'>'.$plan->plan_alias.'</option>';
  }
  if($plan->plan_name === 'Advanced'){
    $advanced .='<option value='.$plan->id.'>'.$plan->plan_alias.'</option>';
  }
  if($plan->plan_name === 'Premium'){
    $premium .='<option value='.$plan->id.'>'.$plan->plan_alias.'</option>';
  }
}
$cards = Lang::get('cards');
$index = 1;
@endphp
<ul id="plan-list" class="clearfix">
 @foreach($cards as $card)
        <li class="most-pop card{{ $index }}">
            <div class="title">{{ $card['name'] }}</div>
            <div class="price">
                <span class="currency">$</span>
                <span class="coin"><?= number_format(($card['price']/100), 2, '<span class="cents">.', '') ?></span></span>
            </div>
            <div class="plan-type">
                Per month
            </div>

            <ul class="feature-list">
              {!! $card['advantages'] !!}
            </ul>

            <select>
              @php
              if ($card['name'] === 'Basic'){ echo $basic; }
              if ($card['name'] === 'Advanced'){ echo $advanced; }
              if ($card['name'] === 'Premium'){ echo $premium; }
              @endphp
            </select>
            @if (Request::path() === 'plans')
              <input type="radio" name="card_id" id="card{{ $index }}" class="hidden radio-label" value="card{{ $index }}" required>
              <label for="card{{ $index }}" class="btn-{{ $card['color'] }} button-label {{ $card['name'] }}"
                @if ( $index === 1)
                {{ $isHidden }}
                @endif
              >
              <h1>{{ $card['button'] }}</h1>
              </label>
            @endif
            @if (Request::path() === '/')
              <a href="{{ url('plans') }}" class="btn-{{ __('plans.'.$plan->id.'_color') }}"> {{ __('plans.'.$plan->id.'_button') }} </a>
            @endif
        </li>
      @php
      $index ++;
      @endphp
  @endforeach
</ul>
