@extends('layouts.app')

@section('page-title', trans('app.qualification'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.qualification_app')</h3>
            </div>
          </div>
        
          <div class="x_content">
             {!! Form::open(['route' => 'qualification.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
                <div class="starrr stars-existing" data-rating='{!! $quantify !!}'></div>
                @lang('app.your_qualification') <span class="stars-count-existing">{!! $quantify !!}</span> @lang('app.starts')
                {!! Form::hidden('quantify', $quantify, ['id' => 'quantify_start']) !!}

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-primary btn-submit col-sm-3 col-xs-6">@lang('app.save')</button>
                </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')
    {!! HTML::style("public/vendors/starrr/dist/starrr.css") !!}
@endsection

@section('scripts')
@parent

    <!-- starrr -->
    {!! HTML::script('public/vendors/starrr/dist/starrr.js') !!}

    <script>
      $(document).ready(function() {

        $('.stars-existing').starrr({
          rating: {!! $quantify !!}
        });

        $('.stars-existing').on('starrr:change', function (e, value) {
          $('.stars-count-existing').html(value);
          $('#quantify_start').val(value);
        });
      });
    </script>
    <!-- /Starrr -->
@endsection

