<div class="modal-body">
@if($edit)
{!! Form::model($faq, ['route' => ['faq.update', $faq->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@else
 {!! Form::open(['route' => 'faq.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@endif
  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.question')">@lang('app.question') <span class="required">*</span>
    </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
    {!! Form::text('question', old('question'), ['class' => 'form-control col-md-12 col-xs-12', 'id' => 'question']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.answer')">@lang('app.answer') <span class="required">*</span>
    </label>
    <div class="col-md-10 col-sm-10 col-xs-12">
    {!! Form::textarea('answer', old('answer'), ['class' => 'form-control', 'id' => 'answer', 'rows' => '7']) !!}
    </div>
  </div> 
  <div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.status')">@lang('app.status') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-8">
      {!! Form::select('status', $status, 'Published', ['class' => 'form-control', 'id' => 'status']) !!}
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

