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
    <title>تسجيل الدخول</title>
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
                                <h4 class="text-center mb-4">قم بتسجيل الدخول إلى حسابك</h4>
                                <form method="POST" class="form-valide" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label><strong>البريد الاليكتروني</strong></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>كلمة المرور</strong></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
                                        @error('password')
                                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" class="custom-control-input" id="basic_checkbox_1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="basic_checkbox_1">تذكرني</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="page-forgot-password.html">هل نسيت كلمة السر؟</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">سجل دخولي</button>
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
