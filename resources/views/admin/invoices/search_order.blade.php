 @if(!empty($orders['orders']))
                                 <?php if ($orders['orders'] instanceof \Illuminate\Pagination\LengthAwarePaginator){ ?>
                                    <?php $count=$orders['orders']->firstItem(); ?>
                                  <?php }else{ ?>
                                    <?php $count=1;?>
                                  <?php } ?>
                            @foreach($orders['orders'] as $order_key => $new)
                            @php //dd($new); @endphp
                            <tr data-id="{{$new->id}}" id="clienttbl_row_{{$new->id}}" class="even">
                              <!-- <td><input class="sub_chk" name="id[]" value="{{$new->id}}" type="checkbox"/></td> -->
                              <td>
                                {{ Form::checkbox('orders_checkbox[]', $new->id, false, ['class' => 'sub_chk']) }}
                              </td>
                              <td class="order-index-{{ $new->id }}">
                                {{$count}}
                              </td>
                              <td><a class="order-txn-id-{{ $new->id }}" href="{{url('admin/billing_invoice_edit').'/'.$new->id}}">MY-{{$new->transaction_id}}</a></td>
                              <td><a href="#link to receipt details">{{$new->id}}</a></td>
                              <td>{{$new->created_at}}</td>
                              <td>
                                @if ($new->user->full_name)
                                  <a class="order-client-name-{{ $new->id }}" href="client_edit.html">
                                    {{ $new->user->full_name }}
                                  </a>
                                @else
                                  <span><em>No name provided</em></span>
                                @endif
                              </td>
                              <td>
                                <a href="client_edit.html">
                                  {{ $new->user->user_client_id }}
                                </a>
                              </td>
                              
                              <td>
                                RM {{ number_format($new->total_amount, 2)}}
                              </td>
                              <td>
                                @if ($new->payment_method)
                                  {{ $new->payment_method->name }}
                                @else
                                  <em>Not specified</em>
                                @endif
                              </td>
                              <td>
                                @if($new->status == 'COMPLETED')
                                  <span class="label label-xs label-success">
                                    Paid
                                  </span>
                                @elseif ($new->status === 'INCOMPLETE')
                                  <span class="label label-xs label-warning">
                                    Unpaid
                                  </span>
                                @else
                                  <span class="label label-xs label-danger">
                                    Payment Failed
                                  </span>
                                @endif
                              </td>
                              <td>
                                <a href="{{url('admin/billing_invoice_edit').'/'.$new->id}}" data-hover="tooltip" data-placement="top" title="Edit">
                                  <span class="label label-sm label-success">
                                    <i class="fa fa-pencil"></i>
                                  </span>
                                </a>
                                <a href="#" data-hover="tooltip" data-placement="top" class="single-delete-btn" title="Delete" data-id="{{ $new->id }}" data-toggle="modal">
                                  <span class="label label-sm label-red delete_icon">
                                    <i class="fa fa-trash-o"></i>
                                  </span>
                                </a>
                                <!-- modal delete end -->
                              </td>
                            </tr>
                            <?php $count++; ?>
                                @endforeach
                            @endif
                             {{ Form::submit('Submit', [ 'class' => 'delete-submit hidden' ]) }}