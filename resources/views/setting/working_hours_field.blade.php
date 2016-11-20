{!! Form::open(['route' => 'setting.update.working.hours', 'class' => 'form-horizontal form-label-left']) !!}
  <div class="form-group">
    <button type="button" onClick="add_working_hour()" class="btn btn-default">@lang('app.add_interval')</button>
  </div>

  <div class="col-md-9 col-sm-10 col-xs-12">
    <div id="content-table">
      <div id="load_working_hours"> 
        <table class="table" id="working_hours_table">
        <thead>
        <tr>
          <th>@lang('app.date_start')</th>
          <th>@lang('app.end')</th>
          <th>@lang('app.quantity_reserve')</th>
          <th>@lang('app.status')</th>
          <th width="10%">@lang('app.actions')</th>
        </tr>
        </thead>
        <tbody id="working_hours_list" class="form-horizontal">

          @foreach ($working_hours as $key => $working_hour)
          <tr>
            <td><input type="text" name="start[]" id="{{$key}}" class="form-control" value="{{$working_hour['start']}}" required="required" readonly="readonly"></td>
            <td><input type="text" name="end[]" id="end-{{$key}}" class="form-control" value="{{$working_hour['end']}}" required="required" readonly="readonly"></td>
            <td><input type="number" name="quantity[]" class="form-control" value="{{$working_hour['quantity']}}" required="required"></td>
            <td>{!! Form::select('status', $status, $working_hour['status'], ['class' => 'form-control']) !!}</td>
            <td>
            @if($key != 0)
              <button type="button"  class="btn btn-round btn-danger btn-xs delete-hour"> 
                <i class="fa fa-trash"></i>
              </button>
            @endif
            </td>
          </tr>
          @endforeach
          <!-- load content locations -->
        </tbody>
        </table>
      </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">@lang('app.update')</button>
    </div>
  </div>
{!! Form::close() !!}