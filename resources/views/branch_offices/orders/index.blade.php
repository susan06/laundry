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
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
              @include('branch_offices.orders.list')
            </div>
                
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">

setInterval(getPages(CURRENT_URL),60000);

$(document).on('click', '.btn-submit-reason', function (e) {
  e.preventDefault();
  showLoading();
  var form = $('#form-modal-reason'); 
  $.ajax({
      url: form.attr('action'),
      type: 'post',
      data: form.serialize(),
      dataType: 'json',
      success: function(response) {
          hideLoading();
          if(response.success){
              $('#general-modal').modal('hide');
              notify('success', response.message);
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