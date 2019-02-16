<thead>
  <tr>
    <th>
        Plan
    </th>
    <th>
        Expires on
    </th>
    <th>
        Price
    </th>
    <th>
        Method
    </th>
    <th>
        Renovation
    </th>
  </tr>
</thead>
<tbody>
  @foreach ($payment as $pay)

  <tr>
    <td>
        {{ $pay->plan_name }}
    </td>
    <td>
        @php
        if(time() > $pay->expiry_at){
          echo 'Expired';
          $button = 0;
        }
        else{
          echo date('Y/m/d', $pay->expiry_at);
          $button = 1;
        }
        @endphp
    </td>
    <td>
        ${{ $pay->price/100 }}
    </td>
    <td>
        {{ $pay->method }}
    </td>
    <td>

      @if ($pay->auto_renew === 1)
        <button href="#" class="btn-green">Auto paid</button>
      @elseif ($button === 1 && $pay->method === 'PayPal')
        <form action="{{ url('/paypalsub') }}" method="post">
          @csrf
          <input type="hidden" name="plan" value="{{$pay->plan_name}}">
          <input type="hidden" name="expire" value="{{$pay->expiry_at}}">
          <button href="#" class="btn-green">Get Autopay</button>
        </form>
      @else
        <a href="#" class="btn-gray">Do not renew</a>
      @endif
    </td>
  </tr>
  @endforeach
</tbody>
</table>
