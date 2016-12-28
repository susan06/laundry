<!--edit or create Modal-->
<div class="modal fade bs-example-modal-lg" id="general-modal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="modal-title"></h4>
      </div>
      <div id="content-modal">
        <!--content load -->
      </div>
    </div>
  </div>
</div>
<!-- /.modal --> 

@if (Auth::user()->role->name == 'client')
<div class="modal fade bs-example-modal-lg" id="suggestion-modal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">@lang('app.suggestions')</h4>
      </div>
      <div class="modal-body">
       {!! Form::open(['route' => 'suggestion.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => trans('app.write_suggestion')]) !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-submit col-sm-3 col-xs-6">@lang('app.send')</button>
        <button type="button" class="btn btn-default col-sm-3 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endif 
