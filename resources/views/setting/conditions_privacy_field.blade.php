<div class="" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
      <li role="presentation" class="active"><a href="#tab_content1" id="conditions-tab" role="tab" data-toggle="tab" aria-expanded="true">@lang('app.terms_and_conditions')</a>
      </li>
      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="privacy-tab" data-toggle="tab" aria-expanded="false">@lang('app.privacy_policy')</a>
      </li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="conditions-tab">
      {!! Form::open(['route' => 'setting.update', 'class' => 'form-horizontal form-label-left']) !!}
      <div id="alerts"></div>
      @include('partials.toolbar_editor')
      <div id="editor2" class="editor-wrapper">{{Settings::get('terms_and_conditions')}}</div>
      <textarea name="terms_and_conditions" id="terms_and_conditions" style="display: none;" required="required">{{Settings::get('terms_and_conditions')}}</textarea>
      <div class="ln_solid"></div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">@lang('app.update')</button>
      </div>
      {!! Form::close() !!}
      </div>
      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="privacy-tab">
      {!! Form::open(['route' => 'setting.update', 'class' => 'form-horizontal form-label-left']) !!}
      <div id="alerts"></div>
      @include('partials.toolbar_editor')
      <div id="editor3" class="editor-wrapper">{{Settings::get('privacy_policy')}}</div>

      <textarea name="privacy_policy" id="privacy_policy" style="display: none;" required="required">{{Settings::get('privacy_policy')}}</textarea>

        <div class="ln_solid"></div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">@lang('app.update')</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

