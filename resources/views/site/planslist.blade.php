<ul id="plan-list" class="clearfix">
    @foreach ($plans as $plan)
        <li class="plan-{{ $plan->plan_alias }} most-pop">
            <div class="title">{{ __('plans.'.$plan->id.'_name') }}</div>
            <div class="price">
                <span class="currency">$</span>
                <span class="coin"><?= number_format(($plan->price/100), 2, '<span class="cents">.', '') ?></span></span>
            </div>
            <div class="plan-type">
                Per month
            </div>

            <ul class="feature-list">
              {!! __('plans.'.$plan->id.'_advantages') !!}
            </ul>

            {!! __('plans.'.$plan->id.'_more') !!}
            @if (Request::path() === 'plans')
              <input type="radio" name="plan_id" id="{{ $plan->plan_alias }}" class="hidden radio-label" value="{{ $plan->id }}" required>
              <label for="{{ $plan->plan_alias }}" class="btn-{{ __('plans.'.$plan->id.'_color') }} button-label {{ __('plans.'.$plan->id.'_name') }}"
                @if ( $plan->id === 1)
                {{ $isHidden }}
                @endif
              >
              <h1>{{ __('plans.'.$plan->id.'_button') }}</h1>
              </label>
            @endif
            @if (Request::path() === '/')
              <a href="{{ url('plans') }}" class="btn-{{ __('plans.'.$plan->id.'_color') }}"> {{ __('plans.'.$plan->id.'_button') }} </a>
            @endif
        </li>
    @endforeach

</ul>
