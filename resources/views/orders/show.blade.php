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

@sections('scripts')

{!! HTML::script('public/assets/js/show_map.js') !!}

@endsection