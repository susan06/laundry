<div class="modal fade bs-example-modal-lg" id="modal_branch_offices" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999">
  <div class="modal-dialog modal-lg">
    <div class="modal-content form-horizontal">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">@lang('app.branch_offices')</h4>
      </div>
      <div class="modal-body">
      {!! Form::open(['method' => 'get', 'class' => 'form-horizontal form-label-left']) !!}
        <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
        @if (session('branch_offices'))
          <select name="branch_office_id" class="form-control">
            @foreach(session('branch_offices') as $office_id => $office)
            <option value="{{ $office_id }}">{{ $office }}</option>
            @endforeach
          </select>
        @endif
        </div>
        </div>
      </div>
       <div class="modal-footer">
         <button type="submit" class="btn btn-primary col-sm-2 col-xs-6">@lang('app.save')</button>
         <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
       </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>