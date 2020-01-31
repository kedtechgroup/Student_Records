@extends('auth.layouts.auth.master')

@section('content')

    <!-- Login card -->
    <form class="login-form" method="POST" action="{{route('login')}}">
        @csrf
        <div class="card mb-0 shadow-2 rounded-top-3">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0"> Login to your account </h5>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="email"
                           type="email"
                           class="form-control"
                           placeholder="email@example.com"
                           name="email"
                           value="{{old('email')}}">
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>

                    @if($errors->has('email'))
                        <label class="validation-invalid-label">{{ $errors->first('email') }}</label>
                    @endif

                </div>


                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password"
                           id="password"
                           class="form-control"
                           placeholder="Enter your password"
                           name="password">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>

                    @if($errors->has('password'))
                        <label class="validation-invalid-label">{{ $errors->first('password') }}</label>
                    @endif

                </div>

                <div class="form-group d-flex align-items-center">
                    <div class="form-check mb-0">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-input-styled">
                            Remember Me
                        </label>
                    </div>
                    @if ($errors->has('password'))
                        <a href="{{ route('password.request') }}"
                           class="ml-auto"> Forgot my password </a>
                    @endif

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                        <i class="icon-circle-right2 ml-2"></i>
                    </button>
                </div>

            </div>
        </div>
    </form>
    <!-- /login card -->

@endsection

@push('js')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.form-input-styled').uniform();
        });
    </script>
@endpush
