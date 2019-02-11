<ul id="plan-list" class="clearfix">
    @foreach ($plans as $plan)
        <li class="plan-{{ $plan->plan_alias }} most-pop">
            <div class="title">{{ $plan->plan_name }}</div>
            <div class="price">
                <span class="currency">$</span>
                <span class="coin"><?= number_format($plan->price, 2, '<span class="cents">.', '') ?></span></span>
            </div>
            <div class="plan-type">
                Per month
            </div>

            <ul class="feature-list">
                {!! $plan->advantages !!}
            </ul>

            {!! $plan->more_advantages !!}
            @if (Request::path() === 'plans')
              <input type="radio" name="plan_id" id="{{ $plan->plan_alias }}" class="hidden radio-label" value="{{ $plan->id }}" required>
              <label for="{{ $plan->plan_alias }}" class="btn-{{ $plan->button_color }} button-label {{ $plan->plan_name }}"
                @if ($plan->plan_name === "Basic")
                {{ $isHidden }}
                @endif
              >
              <h1>{{ $plan->button_text }}</h1>
              </label>
            @endif
            @if (Request::path() === '/')
              <a href="{{ url('plans') }}" class="btn-{{ $plan->button_color }}"> {{ $plan->button_text }} </a>
            @endif
        </li>
    @endforeach

</ul>
