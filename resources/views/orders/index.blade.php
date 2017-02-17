@extends('layouts.app')

@section('page-title', trans('app.orders'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.orders')</h2>
  </div>
<!--//banner-->

<div class="content">
    <div id="content-table">
        @include('orders.list')
    </div>
</div>

@endsection

@section('scripts')
@parent

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
</script>
@endsection