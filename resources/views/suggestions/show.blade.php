<div class="modal-body">
  <h2 class="title">@lang('app.suggestion')</h2>
  <p class="excerpt">{{ $suggestion->content }}</p>
  <div class="tags">{{ trans('app.write_by').' '.$suggestion->user->full_name() }}</span>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
</div>

