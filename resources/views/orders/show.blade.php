@extends('layouts.app')

@section('page-title', trans('app.order'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        
          <div class="x_content">

            <div id="content-table">
              @include('orders.show_content')
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

<script type="text/javascript">
  $(document).on('shown.bs.modal', '#show_map_modal', function (e) {
      google.maps.event.trigger(map, "resize");
      map.setCenter(center);
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
 
{!! HTML::script('public/assets/js/show_map.js') !!}

@endsection