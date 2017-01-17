<div class="modal-body">
 {!! Form::open(['route' => ['branch-office.order.incomplete.update', $order->id], 'id' => 'form-modal', 'method' => 'post', 'class' => 'form-horizontal form-label-left']) !!}

  <div class="form-group">
    <div class="col-md-12 col-sm-12 col-xs-12">
    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => trans('app.write_reazon_change_branch').' '.$order->bag_code, 'required' => 'required']) !!}
    </div>
  </div>
 </div>
<div class="modal-footer">
  <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.save')</button>
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}