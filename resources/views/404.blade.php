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
    <title>{{__('Error')}}</title>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>
<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-5">
                <div class="form-input-content text-center error-page">
                    <h1 class="error-text font-weight-bold">404</h1>
                    <h4><i class="fa fa-exclamation-triangle text-warning"></i> الصفحة التي تبحث عنها غير موجودة!</h4>
                    <p>ربما أخطأت في كتابة العنوان أو ربما تم نقل الصفحة.</p>
                    <div>
                        <a class="btn btn-primary" href="{{ url('/' . $page='dashboard') }}">{{__('Go Home')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>