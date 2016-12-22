@extends('layouts.app')

@section('page-title', trans('app.profile'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">

            <div class="x_title">
              <h2>@lang('app.my_profile')</h2>
              <div class="clearfix"></div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 profile_avatar">
            {!! Form::model($user, ['route' => ['update.avatar', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal',  'files' => 'true']) !!}
                  <div class="img-responsive avatar-view">
                        <img class="avatar-view-img" id="avatar-view-img" src="{!! $user->avatar() !!}" height="190" alt="Avatar">
                  </div>
                  <br/>
                  <input style="display: none;" type="file" id="profile_image" name="avatar" value=""/>
                  <br/>
                  <button style="display: none;" type="submit" id="submit_image" class="btn btn-primary col-md-12 col-sm-12 col-xs-12"> @lang('app.change_photo')
                  </button>  
            {!! Form::close() !!}
            </div>

            <div class="col-md-7 col-sm-7 col-xs-12">
                  <div id="content-table">
                    @include('users.list_profile_data')
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <button type="button" data-href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary create-edit-show col-md-12 col-sm-12 col-xs-12" data-model="modal">@lang('app.update_profile')
                      </button>
                    </div>
                  </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
 <!-- jquery.inputmask -->
 {!! HTML::script('public/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') !!}
 <!-- moment -->
 {!! HTML::script('public/assets/js/moment/moment.min.js') !!}
 <!-- bootstrap-daterangepicker -->
 {!! HTML::script('public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}

<script type="text/javascript">

  $(document).on('click', '.avatar-view', function () {
    $("#profile_image").trigger('click');
  });

  $(document).on('change', '#profile_image', function () {
    $("#submit_image").show();
    showLoading();
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#avatar-view-img').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
    hideLoading();
  });

  $(document).on('click', '#submit_image', function () {
    showLoading();
  });
  

</script>
@endsection