@extends('layouts.app')

@section('page-title', trans('app.invited_friends'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.invited_friends')</h3>
            </div>
          </div>
        
          <div class="x_content">
             {!! Form::open(['route' => 'client.friends.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
                <p>@lang('app.invited_friends_win_discount')</p>
                <div class="row">
                  <div class="control-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">@lang('app.add_friends')</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input id="tags_1" type="text" name="friends" class="tags form-control" value="" required="required" placeholder="@lang('app.add_friends')" />
                    </div>
                  </div>
                </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <button type="submit" class="btn btn-primary col-sm-3 col-xs-6">@lang('app.send_invitation')</button>
                </div>
              </div>
            {!! Form::close() !!}

            @if(Auth::user()->client_friends)
              <div class="row"> 
                <div class="t_title">
                  <h2> @lang('app.invitations_sended')</h2>
                  <div class="clearfix"></div>
                </div>
                <table class="table-responsive table table-striped table-bordered dt-responsive nowrap form-horizontal" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>@lang('app.email')</th>
                  <th>@lang('app.status')</th>
                </tr>
                </thead>
                <tbody>

                  @foreach (Auth::user()->client_friends as $key => $value)
                  <tr>
                    <td>{{ $value->email }}</td>
                    <td>
                    {!! $value->get_status() !!}
                    </td>
                  </tr>
                  @endforeach
                  <!-- load content locations -->
                </tbody>
                </table>
              </div>
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')
  
@endsection

@section('scripts')
@parent

    <!-- jQuery Tags Input -->
    {!! HTML::script('public/vendors/jquery.tagsinput/src/jquery.tagsinput.js') !!}

    <!-- jQuery Tags Input -->
    <script>
      function onAddTag(tag) {
        alert("Added a tag: " + tag);
      }

      function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
      }

      function onChangeTag(input, tag) {
        alert("Changed a tag: " + tag);
      }

      $(document).ready(function() {
        $('#tags_1').tagsInput({
          width: 'auto'
        });
      });
    </script>
    <!-- /jQuery Tags Input -->

@endsection

