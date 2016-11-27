 {!! Form::open(['route' => 'admin-package.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left', 'files'=>'true']) !!}

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.category')">@lang('app.category') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('package_category_id', $categories, old('package_category_id'), ['class' => 'form-control col-md-7 col-xs-12 select2_single', 'id' => 'package_category_id']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.image')">@lang('app.image') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <img class="img-responsive avatar-view" id="image_upload" src="public/images/picture.jpg" alt="Avatar" title="@lang('app.change_photo')">
      <input type="file" id="file_image" name="image" value=""/>
      <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
    </div>
  </div>

  <div class="x_title">
    <h2>@lang('app.prices')</h2>
    <div class="clearfix"></div>
  </div>

  @if(count($delivery_hours) > 0)
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <table class="table-responsive table table-striped table-bordered dt-responsive nowrap form-horizontal" cellspacing="0" width="100%">
        <thead>
        <tr>
          <th>@lang('app.interval_delivery')</th>
          <th>@lang('app.price')</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($delivery_hours as $key => $delivery_hour)
          <tr>
            <td>
              {{ $delivery_hour['interval'] }}
              {!! Form::hidden('delivery_schedule[]',$delivery_hour['id']) !!}
            </td>
            <td>
            {!! Form::text('prices[]','', ['class' => 'form-control col-md-7 col-xs-12', 'required' => 'required']) !!}
            </td>
          </tr>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  @endif

  <div class="x_title">
    <h2>@lang('app.description')</h2>
    <div class="clearfix"></div>
  </div>

  <div id="alerts"></div>

  @include('partials.toolbar_editor')

  <div id="editor" class="editor-wrapper">{{old('description')}}</div>

  <textarea name="description" id="description" style="display: none;">{{old('description')}}</textarea>

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="submit" class="btn btn-primary col-sm-2 col-xs-6">@lang('app.save')</button>
      <button type="button" class="btn btn-default btn-cancel col-sm-2 col-xs-5">@lang('app.cancel')</button>
    </div>
  </div>
{!! Form::close() !!}

<!-- Select2 -->
{!! HTML::script('public/vendors/select2/dist/js/select2.full.min.js') !!}
<!-- bootstrap-wysiwyg -->
{!! HTML::script('public/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') !!}
{!! HTML::script('public/vendors/jquery.hotkeys/jquery.hotkeys.js') !!}
{!! HTML::script('public/vendors/google-code-prettify/src/prettify.js') !!}
<!-- Editor-->
{!! HTML::script('public/assets/js/editor.js') !!}

<script type="text/javascript">
  $(".select2_single").select2({
    placeholder: "@lang('app.selected_item')",
    allowClear: true
  });
</script>
