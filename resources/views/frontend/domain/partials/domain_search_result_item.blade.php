<tr>
  <td class="alicent">
    @if ($domain_status[0] === '0')
      {{
        Form::checkbox(
          'domain-search-checkbox[]',
          $key,
          true,
          [
            'data-reference' => $reference_key
          ]
        )
      }}
    @else
      <i class="fa fa-times red"></i>
    @endif
  </td>
  <!-- <td>webqom.com</td> -->
  <td class="col-xs-3">
    {{ $key }}
  </td>
  <td class="col-xs-2">
    @if ($domain_status[0] === '0')
       <input type="hidden" name="text[{{ $key }}]" value="1" id="transfer_text">
        <input type="hidden" name="type[{{$key}}]" value="1">

      <span class="label label-sm label-success">
        Available
      </span>
    @else
      <span class="label label-sm label-red">
        Unavailable
      </span>
    @endif
  </td>
  <td class="col-xs-6">
    @if ($domain_status[0] === '0')
      {{
        Form::select(
          'domain-search-dropdown[' . $key . ']',
          $domain_pricing_list,
          array_keys(array_slice($domain_pricing_list, 1, 1, true))[0],
          [
            'class' => 'form-control input-medium'
          ]
        )
      }}
    @else
      <a href="{{ 'http://' . $key }}" target="_blank">
        WWW</a> | <a href="{{url('whois'.'/'.$key)}}">WHOIS
      </a>
    @endif
  </td>
</tr>
