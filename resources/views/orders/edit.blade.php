
{!! Form::open(['route' => ['order.update', $order->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal']) !!}

  @if($order->before_hour_search() <= 3) 
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      {{ trans('app.penalty_three', ['porcentaje' => $porcentaje, 'monto' => $penalty]) }}
    </div>
  @endif

<table class="table" cellspacing="0" width="100%">
  <tbody>
        <tr>
            <td>
            <div class="title_list_order">@lang('app.searched')</div>
              <div class="float_left">{{ $order->date_search }}</div>
              <div class="float_right"> 
              <select name="time_search" class="form-control" id="time_search">
                @foreach($working_hours as $working_hour)
                @if($working_hour['status'] == 'notavailable')
                   <option value="" disabled="disabled">{{$working_hour['interval'].' - '.trans("app.Not available") }}
                @else
                    @if( Carbon\Carbon::createFromFormat('h:i A', $working_hour['start'])->format('H:i') <= Carbon\Carbon::now()->format('H:i'))
                      <option value="" disabled="disabled">{{$working_hour['interval'].' - '.trans("app.Not available") }}
                    @else
                      <option value="{{$working_hour['id']}}" {{($order->time_search == $working_hour['id']) ? 'selected' : ''}}>{{$working_hour['interval']}} 
                    @endif
                @endif
                @endforeach
              </select>
            </div>
            </td>
        </tr>
  </tbody>
</table>

  <div class="row">
    <div class="title">
      <h4> @lang('app.address')</h4>
      <div class="clearfix"></div>
    </div>
    <div class="col-ms-12 col-md-12 col-xs-12 table">
    {{Form::hidden('client_location_id', $order->client_location_id, ['id' => 'client_location_id'])}}
      <table class="table">
        <thead>
        <tr>
          <th>@lang('app.label')</th>
          <th>@lang('app.address')</th>
          <th width="10%"></th>
        </tr>
        </thead>
          <tbody id="locations_list" class="form-horizontal">
          @foreach($client->client_location as $key => $item)
            @if($item->status == 'accepted')
            <tr class="row_location {{ ($order->client_location_id == $item->id) ? 'success' : '' }}">
              <td>{{ $item->get_label() }}</td>
              <td>{{ $item->address }}</td>
              <td>
                <button type="button" data-location="{{ $item->id }}" class="btn btn-success select-location"> 
                  @lang('app.select')
                </button>
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>
       </table>
    </div>
  </div>

  <div class="row margin-top-10">
    <button type="submit" class="btn btn-primary btn-submit margin-left-5 col-sm-2 col-xs-6">@lang('app.update')</button>
    <button type="button" class="btn btn-default btn-cancel margin-left-5 col-sm-2 col-xs-5">@lang('app.back')</button>
  </div>

{!! Form::close() !!}

<script type="text/javascript">
$(document).on('click', '.select-location', function () {
  var $this = $(this);
  $('.row_location').removeClass('success');
  $this.closest('tr').addClass('success');
  $('#client_location_id').val($this.data('location'));
});
</script>

