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
    {!! Form::text('validity', isset($coupon->validity) ? date_format(date_create($coupon->validity), 'd-m-Y') : old('validity'), ['class' => 'form-control col-md-4 col-xs-6', 'id' => 'validity', 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.percentage')">@lang('app.percentage') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-4">
    {!! Form::text('percentage', old('percentage'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'percentage', 'data-inputmask' => "'mask': '99%'"]) !!}
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

 <!-- jquery.inputmask -->
 {!! HTML::script('public/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') !!}
 <!-- moment -->
 {!! HTML::script('public/assets/js/moment/moment.min.js') !!}
 <!-- bootstrap-daterangepicker -->
 {!! HTML::script('public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}

<script>
  $(document).ready(function() {

      $(":input").inputmask();

      @if($edit)
        $('#validity').datetimepicker({
          format: 'DD-MM-YYYY',
          ignoreReadonly: true
        });
      @else
        $('#validity').datetimepicker({
          format: 'DD-MM-YYYY',
          minDate: new Date(),
          ignoreReadonly: true
        });
      @endif
  });
</script>
