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
        ${{ $pay->price }}
    </td>
    <td>
        {{ $pay->method }}
    </td>
    <td>
      @if ($button === 0 || $pay->method === 'Trial')
      <a href="#" class="btn-gray">Do not renew</a>
      @else
      <a href="#" class="btn-green">Automatic</a>
      @endif
    </td>
  </tr>
  @endforeach
</tbody>
</table>
