<ul id="plan-list" class="clearfix">
    @foreach ($plans as $plan)
        <li class="plan-{{ $plan->plan_alias }} most-pop">
            <div class="title">{{ $plan->plan_name }}</div>
            <div class="price">
                <span class="currency">$</span>
                <span class="coin"><?= number_format(($plan->price/100), 2, '<span class="cents">.', '') ?></span></span>
            </div>
            <div class="plan-type">
                Per month
            </div>

            <ul class="feature-list">
                {!! $plan->advantages !!}
            </ul>

            {!! $plan->more_advantages !!}
            <a
                @auth
                href="javascript:void(0);"
                class="btn-{{ $plan->button_color }} btn-send"
                @endauth

                @guest
                href="{{ url('admin/customer-area') }}"
                class="btn-{{ $plan->button_color }}"
            @endguest
                id="{{ $plan->plan_alias }}"
            @if ($plan->plan_name == "Basic")
                <?/* отваливается страница, если вывод этого параметра незакомменчен. ХЗ может ты не всё что нужно на сервер задеплоил. */?>
            <? /*{{ $isHidden }} */?>
            @endif
            >
            {{ $plan->button_text }}

            </a>
        </li>
    @endforeach

</ul>
