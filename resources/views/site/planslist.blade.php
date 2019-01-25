<ul id="plan-list" class="clearfix">
    @foreach ($plans as $plan)
        <li class="plan-free">
            <div class="title">{{ $plan->plan_name }}</div>
            <div class="price">
                <span class="currency">$</span>
                <span class="coin">{{ $plan->price }}</span>
                <?/*<span class="cents">.00</span>*/?>
            </div>
            <div class="plan-type">
                Per month
            </div>

            <ul class="feature-list">
                {!! $plan->advantages !!}
            </ul>

            <span class="trial">3 days free</span>
            <a href="{{ url('/login') }}" class="btn-orange">test 3 days free</a>
        </li>
    @endforeach


    <?/*<li class="plan-free">
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
            <li>Without credit card</li>
            <li>Without disconnections every minute</li>
            <li>Normal speed</li>
        </ul>

        <span class="trial">3 days free</span>
        <a href="{{ url('/login') }}" class="btn-orange">test 3 days free</a>
    </li>
    <li class="plan-basic most-pop">
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
            <li>50 servers</li>
            <li>Basic support</li>
            <li>Normal speed</li>
        </ul>

        <select name="plan-period" id="plan-period">
            <option value="anual">Anual - 51% of discount</option>
            <option value="anual">Anual - 51% of discount</option>
            <option value="anual">Anual - 51% of discount</option>
        </select>

        <a href="{{ url('/login') }}" class="btn-green">Subscribe now</a>
    </li>
    <li>
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
            <li>More than 100 servers</li>
            <li>High connection speed</li>
            <li>Support premium</li>
        </ul>

        <select name="plan-period" id="plan-period">
            <option value="anual">Anual - 54% of discount</option>
            <option value="anual">Anual - 54% of discount</option>
            <option value="anual">Anual - 54% of discount</option>
        </select>

        <a href="{{ url('/login') }}" class="btn-green">Subscribe now</a>
    </li>*/?>
</ul>
