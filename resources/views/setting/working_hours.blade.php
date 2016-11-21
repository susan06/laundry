@extends('layouts.app')

@section('page-title', trans('app.working_hours'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.working_hours')</h3>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
              @include('setting.working_hours_field')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
@parent

<script type="text/javascript">
  var select_option = {'available':'{{trans("app.Available")}}', 'notavailable':'{{trans("app.Not available")}}'};
  var count = {!! count($working_hours) !!};
</script>

<!-- moment -->
{!! HTML::script('public/assets/js/moment/moment.min.js') !!}
<!-- bootstrap-daterangepicker -->
{!! HTML::script('public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}
<!-- icheck -->
{!! HTML::script('public/vendors/iCheck/icheck.min.js') !!}

{!! HTML::script('public/assets/js/working_hours.js') !!}

@endsection
