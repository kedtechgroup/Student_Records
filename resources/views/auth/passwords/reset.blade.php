@extends('auth.layouts.auth.master')

@section('content')

    <form class="login-form" method="post" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">Reset your password</h5>

                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input id="email"
                           type="email"
                           class="form-control {{ $errors->has('email') ? 'border-danger' : '' }}"
                           name="email"
                           placeholder="Enter your email"
                           value="{{ $email ?? old('email') }}"
                           required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                </div>

                @if($errors->has('email'))
                    <label class="validation-invalid-label">{{ $errors->first('email') }}</label>
                @endif

                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="password"
                           name="password"
                           class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}"
                           placeholder="Enter new password"
                           id="password">
                    <div class="form-control-feedback">
                        <i class="icon-lock text-muted"></i>
                    </div>
                </div>

                @if($errors->has('password'))
                    <label class="validation-invalid-label">{{ $errors->first('password') }}</label>
                @endif

                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="password" class="form-control" placeholder="Confirm yout password"
                           name="password_confirmation"
                           id="password_confirmation">
                    <div class="form-control-feedback">
                        <i class="icon-lock text-muted"></i>
                    </div>
                </div>

                @if($errors->has('password'))
                    <label class="validation-invalid-label">{{ $errors->first('password') }}</label>
                @endif

                <button type="submit" class="btn bg-blue btn-block">
                    <i class="icon-spinner11 mr-2"></i>
                   Reset password
                </button>
            </div>
        </div>
    </form>

@endsection
