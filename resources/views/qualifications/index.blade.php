@extends('layouts.back')

@section('page-title', trans('app.qualifications'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.qualifications')</h3>
               @lang('app.your_qualification') <span class="stars-count-existing">{!! $quantify !!}</span>
               <div class="starrr stars-existing-0" data-rating='{!! $quantify !!}'></div>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
             @include('qualifications.list')
            </div>

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
        $('.stars-existing-0').starrr({
          rating: {!! $quantify !!},
          readOnly: true
        });
        @foreach ($qualifications as $qualification)
        $('.stars-existing-{{$qualification->id}}').starrr({
          rating: {!! $qualification->quantify !!},
          readOnly: true
        });
        @endforeach
      });
    </script>
@endsection