<!DOCTYPE html>
<html lang="en" class="h-100">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Edumin - Bootstrap Admin Dashboard" />
    <meta property="og:title" content="Edumin - Bootstrap Admin Dashboard" />
    <meta property="og:description" content="Edumin - Bootstrap Admin Dashboard" />
    <meta property="og:image" content="https://edumin.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}" />
    <!-- PAGE TITLE HERE -->
    <title>{{ __('Reset Password') }}</title>
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>
<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">

            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">{{ __('Reset Password') }}</h4>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <label><strong>{{ __('E-Mail Address') }}</strong></label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" ><strong>{{ __('Password') }}</strong></label>
                                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" ><strong>{{ __('Confirm Password') }}</strong></label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script type="text/javascript" src="{{ URL::asset('assets/vendor/global/global.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/custom.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/dlabnav-init.js') }}"></script>

</body>
</html>
