<div class="modal fade bs-example-modal-lg" id="modal_branch_offices" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999">
  <div class="modal-dialog modal-lg">
    <div class="modal-content form-horizontal">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">@lang('app.branch_offices')</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        {{ var_dump(session('branch_offices')) }}
        @if (session('branch_offices'))
           {!! Form::select("branch_office_id", session("branch_offices"), session('branch_office'), ["class" => "form-control"]) !!}
        @endif
        </div>
      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary col-sm-2 col-xs-6">@lang('app.save')</button>
         <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
    </div>
    </div>
  </div>
</div>