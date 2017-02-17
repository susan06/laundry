@extends('layouts.app')

@section('page-title', trans('app.invited_friends'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.invited_friends')</h2>
  </div>
<!--//banner-->

  <div class="grid-form">
    <div class="grid-form1">

      <div class="alert alert-info" role="alert">
        @lang('app.invited_friends_win_discount')
       </div>

      {!! Form::open(['route' => 'client.friends.store', 'id' => 'form-modal', 'class' => 'form-horizontal']) !!}
        <div class="form-group">
          <label class="col-sm-2 col-xs-12 control-label hor-form">@lang('app.add_friends')</label>
          <div class="col-sm-10 col-xs-12">
            <input type="text" id="tags_1"  name="friends" class="tags form-control" value="" required="required" placeholder="@lang('app.add_friends')" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10 col-xs-12">
             <button type="submit" class="btn btn-primary btn-submit col-sm-4 col-xs-12">@lang('app.send_invitation')</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>

    @if(Auth::user()->client_friends)
      <div class="grid-form1">
        <h4>@lang('app.invitations_sended')</h4>
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
            </tbody>
        </table>
      </div>
    @endif

</div>


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

