<div class="modal-body">
{!! Form::model($user, ['route' => ['update.avatar', $user->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left',  'files' => 'true']) !!}
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.avatar')">@lang('app.avatar') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <img class="img-responsive avatar-view" id="image_upload" src="{!! asset('storage/users/'.$user->avatar) !!}" alt="Avatar" title="@lang('app.change_photo')">
      <input type="file" id="file_image" name="avatar" value=""/>
      <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
    </div>
  </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}


