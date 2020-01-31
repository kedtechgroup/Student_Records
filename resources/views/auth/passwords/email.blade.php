@extends('auth.layouts.auth.master')

@section('content')

    <form class="login-form" method="post" action="{{ route('password.email') }}">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">Reset your password</h5>
                    <span class="d-block text-muted">We'll send you instructions in email</span>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email">
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                </div>

                @if($errors->has('email'))
                    <label class="validation-invalid-label">{{ $errors->first('email') }}</label>
                @endif

                <button type="submit" class="btn bg-blue btn-block">
                    <i class="icon-spinner11 mr-2"></i>
                   Reset Password
                </button>
            </div>
        </div>
    </form>

@endsection
