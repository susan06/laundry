@extends('layouts.app')

@section('page-title', trans('app.users'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
    
          <div class="x_content">
          <div class="x_panel">
                  <div class="x_title">
                    <h2>@lang('app.user') <small>@lang('app.profile')</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">

                        <!-- end of image cropping -->
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar">

                      </div>
                      </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      
                      <div class="tab-pane in active" id="home">
                          
                          <table class="table">
                            <tr>
                              <td><strong>@lang('app.name'):</strong></td>
                              <td>{{ $user->name }}</td> 
                            </tr>
                            <tr>
                              <td><strong>@lang('app.lastname'):</strong></td>
                              <td>{{ $user->lastname }}</td>
                            </tr>
                            <tr>
                              <td><strong>@lang('app.email'):</strong></td>
                              <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                              <td><strong>@lang('app.phone'):</strong></td>
                              <td>{{ $user->label_phones()}}</td>
                            </tr>
                          </table>
                          <button type="button" data-href="{{ route('profileUser.edit', $user->id).'?role=true' }}" class="btn btn-success btn-primary create-edit-show" data-model="modal" title="@lang('app.edit_user')" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i>@lang('app.edit')
                        </button>
                      <br />
                        </div>
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

@endsection