@extends('layouts.app')

@section('page-title', trans('app.setting'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.setting')</h3>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
              {!! Form::open(['route' => 'client.setting.update', 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.language_default')">@lang('app.language_default')
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! Form::select('lang', $languages, $user->lang, ['class' => 'form-control col-md-7 col-xs-12 select2_single']) !!}
                </div>
              </div>
              <div id="row"> 
                <div class="t_title">
                  <h2> @lang('app.locations_label')</h2>
                  <div class="clearfix"></div>
                </div>
                <table class="table-responsive table table-striped table-bordered dt-responsive nowrap form-horizontal" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>@lang('app.name')</th>
                  <th width="10%">@lang('app.actions')</th>
                </tr>
                </thead>
                <tbody id="locations_label_list">

                  @foreach ($locations_label as $key => $label)
                  <tr>
                    <td><input type="text" name="location_label[]"  class="form-control" value="{{ $label }}" required="required"></td>
                    <td>
                    @if($key != 1)
                      <button type="button"  class="btn btn-round btn-danger btn-xs delete-label-location"> 
                        <i class="fa fa-trash"></i>
                      </button>
                    @endif
                    </td>
                  </tr>
                  @endforeach
                  <!-- load content locations -->
                </tbody>
                </table>
                <div class="row">
                <div class="form-group col-md-3 col-sm-4 col-xs-12">
                  <button type="button" onClick="add_location_label()" class="btn btn-default col-xs-12">@lang('app.add_location_label')</button>
                </div>
              </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group col-md-2 col-sm-2 col-xs-12">
                <button type="submit" class="btn btn-primary col-xs-12">@lang('app.update')</button>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  function add_location_label() {

  var input = document.createElement("input");
  var tr    = document.createElement("TR");
  var td    = document.createElement("TD");  

  input.type  = 'text';
  input.name  = 'location_label[]';
  input.className = 'form-control', 
  input.setAttribute('required', 'required');
  
  var td1    = document.createElement("TD");

  button               = document.createElement('button');
  button.className     = 'btn btn-round btn-danger btn-xs delete-label-location';

  var icon               = document.createElement('i');
  icon.style.cursor  = 'pointer';
  icon.className     = 'fa fa-trash';
  
  button.appendChild(icon);

  td.appendChild(input);
  td1.appendChild(button);

  tr.appendChild(td); 
  tr.appendChild(td1);  

  container = document.getElementById('locations_label_list');
  container.appendChild(tr); 

}

$(document).on('click', '.delete-label-location', function () {
    var row = $(this).closest('tr');
    row.remove();
});
</script>
@endsection