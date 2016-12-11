@if($modal)
<div class="modal-body">
@endif         

@if($order->order_payment)
  {!! Form::open(['route' => ['order.payment.update', $order->order_payment->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@else
 {!! Form::open(['route' => ['order.payment.store', $order->id], 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@endif

@if($order->order_payment)

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.method_payment')">@lang('app.method_payment') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-12">
      {!! Form::select('payment_method_id', $payments, $order->order_payment->payment_method_id, ['class' => 'form-control', 'id' => 'payment_method_id']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.reference')">@lang('app.reference') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-12">
    {!! Form::text('reference', $order->order_payment->reference, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'reference']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.price')">@lang('app.price') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-12">
    {!! Form::text('amount', $order->order_payment->amount, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'amount']) !!}
    </div>
  </div>
@else
  
    <div class="alert alert-info alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      Estimado cliente, en estos momentos su pedido ha sido programado y está en espera para su pago, por favor seleccionar su método de pago y nuestro equipo lo verificará, una vez verificado se procederá a la búsqueda de su ropa
    </div>
  <br/>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.method_payment')">@lang('app.method_payment') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-12">
      {!! Form::select('payment_method_id', $payments, old('payment_method_id'), ['class' => 'form-control', 'id' => 'payment_method_id']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.reference_or_number')">@lang('app.reference_or_number') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-12">
    {!! Form::text('reference', old('reference'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'reference']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.price')">@lang('app.price') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-12">
    {!! Form::text('amount', $order->total, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'amount']) !!}
    </div>
  </div>
@endif

@if($modal)
</div>
@endif   

@if($modal)
<div class="modal-footer">
  @if($order->order_payment)
    <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
  @else
      <button type="submit" class="btn btn-primary btn-submit col-sm-2 -xs-6">@lang('app.save')</button>
  @endif
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
@else
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    @if($order->order_payment)
      <button type="submit" class="btn btn-primary btn-submit col-sm-3 col-xs-6">@lang('app.update')xx</button>
    @else
      <button type="submit" class="btn btn-primary btn-submit col-sm-3 col-xs-6">@lang('app.save')tt</button>
    @endif
      <button type="button" class="btn btn-default btn-cancel col-sm-3 col-xs-5">@lang('app.cancel')</button>
    </div>
  </div>
@endif 

{!! Form::close() !!}