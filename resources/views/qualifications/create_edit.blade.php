@extends('layouts.app')

@section('page-title', trans('app.qualification'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.qualification_app')</h2>
  </div>
<!--//banner-->


  <div class="grid-form">
    <div class="grid-form1">
     {!! Form::open(['route' => 'qualification.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
        <div class="row clear text-center margin-bottom-10">
         <div class="starrr stars-existing" data-rating='{!! $quantify !!}'></div>

          <br>
          @lang('app.your_qualification') <span class="stars-count-existing">{!! $quantify !!}</span> @lang('app.starts')

          {!! Form::hidden('quantify', $quantify, ['id' => 'quantify_start']) !!}

       </div> 
        <div class="form-group aling-center-button">
            <button type="submit" class="btn btn-primary btn-submit col-sm-3 col-xs-12">@lang('app.save')</button>
        </div>

        {!! Form::close() !!}
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

