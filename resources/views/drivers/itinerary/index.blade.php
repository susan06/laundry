@extends('layouts.back')

@section('page-title', trans('app.orders'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title no-print">
            <div class="title_left">
              <h3>{{ $title }}</h3>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
              {!! Form::select('status_driver', $status_driver, old('status_driver'), ['class' => 'form-control', 'id' => 'status_driver']) !!}
            </div>
             <div>
              <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" id="search" class="form-control" placeholder="@lang('app.write_here')">
                  <span class="input-group-btn">
                    <button class="btn btn-danger search-cancel" type="button"><i class="fa fa-close"></i></button>
                    <button class="btn btn-primary search" type="button">@lang('app.search')</button>
                  </span>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
              @include('drivers.itinerary.list')
            </div>
                
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts_head')
@parent
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language={{Auth::User()->lang}}"></script>
@endsection

@section('scripts')
@parent

{!! HTML::script('public/assets/js/show_map.js') !!}

<script type="text/javascript">
// search status order payment all
$(document).on('change', '#status_driver', function () {
    showLoading();
    var $this = $(this);
    $.ajax({
        url: CURRENT_URL,
        type:"GET",
        data:{ status_driver: $this.val() },
        dataType: 'json',
        success: function(response) {
            CURRENT_URL = this.url;
            hideLoading();
            if(response.success){
                $('#content-table').html(response.view);
                loadResposiveTable();
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

$(document).on('click', '.btn-code-submit', function (e) {
  e.preventDefault();
  showLoading();
  var form = $('#form-bag-code'); 
  var type = $('#form-bag-code input[name="_method"]').val();
  if(typeof type == "undefined") {
      type = form.attr('method');
  }
  $.ajax({
      url: form.attr('action'),
      type: type,
      data: form.serialize(),
      dataType: 'json',
      success: function(response) {
          hideLoading();
          if(response.success){
              if(current_model == 'modal') {
                  $('#general-modal').modal('hide');
              } else {
                  if(current_model == 'content' && !response.url_return) {
                      if(response.url_next){
                          $('#content-title').text(response.title_next);
                          getPages(response.url_next);
                      } else {
                          $('#content-title').text(current_title);
                          $('.btn-create').show();
                          $('.top_search').show();
                      }
                  } else {
                      if(response.url_return) {
                          window.location.href = response.url_return;
                          showLoading();
                      }
                  } 
              }
              notify('success', response.message);
              form.get(0).reset();
              getPages(CURRENT_URL);
          } else {
              if(response.validator) {
                var message = '';
                $.each(response.message, function(key, value) {
                  message += value+' ';
                });
                notify('error', message);
              } else {
                notify('error', response.message);
              }
          }
         
      },
      error: function (status) {
          hideLoading();
          notify('error', status.statusText);
      }
  });
});
</script>
@endsection