@extends('layouts.app')

@section('page-title', trans('app.setting'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.setting')</h2>
  </div>
<!--//banner-->

  <div class="grid-form">
    <div class="grid-form1">
        {!! Form::open(['route' => 'client.setting.update', 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 hor-form" for="@lang('app.language_default')">@lang('app.language_default')
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::select('lang', $languages, $user->lang, ['class' => 'form-control col-md-7 col-xs-12 select2_single']) !!}
            </div>
          </div>
          <br>
          <div class="form-group"> 
             <label class="control-label col-md-3 col-sm-3 col-xs-12 hor-form" for="@lang('app.locations_label')">@lang('app.locations_label')
            </label>
          </div>
          <div class="form-group aling-center-button">
              <button type="button" onClick="add_location_label()" class="btn btn-default col-sm-3 col-xs-12">@lang('app.add_location_label')</button>
          </div>

          <div class="row clear">
          <div class="col-sm-6 col-xs-12">
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
                    <td class="text-center">
                    @if($key != 1)
                      <button type="button"  class="btn btn-danger delete-label-location"> 
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

          <br>

          <div class="form-group aling-center-button">
            <button type="submit" class="btn btn-primary col-sm-3 col-xs-12">@lang('app.update')</button>
          </div>

          {!! Form::close() !!}
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