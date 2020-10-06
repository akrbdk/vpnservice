<ul id="country-list">
    <!-- <li>
        <img src="{{ asset('site/img/flag-1.png') }}" alt="">
        <span>3</span>

        <div class="cities">
            <p>São Paulo - SP</p>
            <p>Rio de Janeiro - RJ</p>
            <p>Porto Alegre - RS</p>
        </div>
    </li> -->
    @foreach ($servers as $server)
    @php
    $src = "site/img/flag-".$server->country_iso.".png";
    @endphp
      <li><img src="{{ asset($src) }}" alt=""><span>{{$server->total}}</span></li>
    @endforeach

    <li>and counting...</li>
</ul>
