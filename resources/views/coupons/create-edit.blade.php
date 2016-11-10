<div class="modal-body">
@if($edit)
{!! Form::model($coupon, ['route' => ['coupon.update', $coupon->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@else
 {!! Form::open(['route' => 'coupon.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@endif
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.code')">@lang('app.code') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('code', (isset($code)) ? $code : $coupon->codeDecrypt(), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'code', 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.validity')">@lang('app.validity') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('validity', old('validity'), ['class' => 'form-control col-md-4 col-xs-6', 'id' => 'validity']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.percentage')">@lang('app.percentage') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-4">
    {!! Form::number('percentage', old('percentage'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'percentage']) !!}
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
  @if($edit)
    <button type="submit" class="btn btn-primary btn-submit">@lang('app.update')</button>
  @else
      <button type="submit" class="btn btn-primary btn-submit">@lang('app.save')</button>
  @endif
</div>
{!! Form::close() !!}

