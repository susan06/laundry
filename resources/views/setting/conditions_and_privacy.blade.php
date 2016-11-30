@extends('layouts.app')

@section('page-title', trans('app.terms_service'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.terms_service')</h3>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="content-table">
              @include('setting.conditions_privacy_field')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<!-- Select2 -->
{!! HTML::script('public/vendors/select2/dist/js/select2.full.min.js') !!}
<!-- bootstrap-wysiwyg -->
{!! HTML::script('public/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') !!}
{!! HTML::script('public/vendors/jquery.hotkeys/jquery.hotkeys.js') !!}
{!! HTML::script('public/vendors/google-code-prettify/src/prettify.js') !!}
<!-- Editor-->
{!! HTML::script('public/assets/js/editor.js') !!}

<script type="text/javascript">
  $(".select2_single").select2({
    placeholder: "@lang('app.selected_item')",
    allowClear: true
  });
</script>
@endsection