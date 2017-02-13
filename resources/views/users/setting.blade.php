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
              {!! Form::open(['route' => 'user.setting.update', 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.language_default')">@lang('app.language_default')
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! Form::select('lang', $languages, $user->lang, ['class' => 'form-control col-md-7 col-xs-12 select2_single']) !!}
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group col-md-2 col-sm-2 col-xs-12">
                <button type="submit" class="btn btn-primary col-xs-12">@lang('app.update')</button>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
