<thead>
  <tr>
    <th>
        @lang('paymentlist.plan')
    </th>
    <th>
        @lang('paymentlist.expiry_on')
    </th>
    <th>
        @lang('paymentlist.price')
    </th>
    <th>
        @lang('paymentlist.method')
    </th>
    <th>
        @lang('paymentlist.renovation')
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
          echo trans('paymentlist.expired');
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
        <button href="#" class="btn-green">@lang('paymentlist.subscribed')</button>
      @elseif ($button === 1 && $pay->method === 'PayPal')
        <form action="{{ url('/paypalsub') }}" method="post">
          @csrf
          <input type="hidden" name="plan_id" value="{{$pay->plan_id}}">
          <input type="hidden" name="pay_id" value="{{$pay->id}}">
          <button href="#" class="btn-green">@lang('paymentlist.start_subscription')</button>
        </form>
      @elseif ($button === 1 && $pay->method === 'Card')
        <form action="{{ url('/stripesub') }}" method="post">
          @csrf
          <input type="hidden" name="plan_id" value="{{$pay->plan_id}}">
          <input type="hidden" name="pay_id" value="{{$pay->id}}">
          <button href="#" class="btn-green">@lang('paymentlist.start_subscription')</button>
        </form>
      @else
        <a href="#" class="btn-gray">@lang('paymentlist.unsubscribed')</a>
      @endif
    </td>
  </tr>
  @endforeach
</tbody>
</table>
