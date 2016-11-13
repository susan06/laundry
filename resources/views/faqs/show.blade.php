<div class="modal-body">
  <h2 class="title">{{ $faq->question }}</h2>
  <p class="excerpt">{{ $faq->answer }}</p>
  <div class="tags">
    <span class="label label-{{ $faq->labelClass() }}">{{ trans("app.{$faq->status}") }}</span>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
</div>

