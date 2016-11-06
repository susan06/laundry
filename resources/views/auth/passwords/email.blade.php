@extends('layouts.auth')

<!-- Main Content -->
@section('content')
<div class="center-block">
    <div class="login-block">
        <header>
          <div class="image-block"><img src="{{ url('assets/images/logo.png') }}" alt="Logo" /></div>
          Reset Password<small><a href="{{ url('/') }}">Login</a></small>
        </header>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-3 col-xs-3 control-label">Email</label>

                    <div class="col-md-9 col-xs-9">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3 col-xs-3"></div>
                    <div class="col-md-9 col-xs-9 buttons-margin-bottom">
                        <button type="submit" class="btn btn-primary">
                            Send Password Reset Link
                        </button>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection
