@if($modal)
<div class="modal-body">
@endif         

{!! Form::open(['route' => ['order.payment.penalty.update', $order->order_penalty->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.method_payment')">@lang('app.method_payment') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-12">
      {!! Form::select('payment_method_id', $payments, $order->order_penalty->payment_method_id, ['class' => 'form-control', 'id' => 'payment_method_id']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.reference')">@lang('app.reference') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-12">
    {!! Form::text('reference', $order->order_penalty->reference, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'reference']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.price')">@lang('app.price') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-12">
    {!! Form::text('amount', $order->order_penalty->amount, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'amount', 'readonly' => 'readonly']) !!}
    </div>
  </div>

@if($modal)
</div>
@endif   

@if($modal)
<div class="modal-footer">
  <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
@else
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="submit" class="btn btn-primary btn-submit col-sm-3 col-xs-6">@lang('app.update')</button>
      <button type="button" class="btn btn-default btn-cancel col-sm-3 col-xs-5">@lang('app.cancel')</button>
    </div>
  </div>
@endif 

{!! Form::close() !!}