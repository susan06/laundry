@extends('layouts.back')

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
              @include('setting.administration_field')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')
    <!-- Switchery -->
    {!! HTML::style("public/vendors/switchery/dist/switchery.min.css") !!}
@endsection

@section('scripts')
    <!-- Switchery -->
    {!! HTML::script('public/vendors/switchery/dist/switchery.min.js') !!}
    <!-- Select2 -->
  {!! HTML::script('public/vendors/select2/dist/js/select2.full.min.js') !!}

  <script type="text/javascript">
    $(".select2_single").select2({
      placeholder: "@lang('app.selected_item')"
    });
  </script>

@endsection