@extends('layouts.master')
@section('title')
    تعديل مستخدم / ({{$user->name}})
@endsection
@section('css')
    <style>
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #ffffff;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: "FontAwesome";
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #f8f8f8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>تعديل مستخدم</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> المستخدمين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='users/create')}}">تعديل مستخدم</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">تعديل مستخدم</h5>
                </div>
                @can('تعديل مستخدم')
                <div class="card-body">
                    <form action="{{ route('users.update', 'test') }}" enctype="multipart/form-data" method="post">
                        {{ method_field('patch') }}
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="user_image" accept=".png, .jpg, .jpeg" @if($user->id !== Auth::user()->id) disabled @endif/>
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image:
                                            @if(empty($user->user_image))
                                                url({{URL::asset('assets/images/avatar/1.png')}});
                                            @else
                                                url({{URL::asset('/storage/user_profile/'.$user->id .'/'. $user->user_image )}});
                                            @endif

                                                ">
                                            </div>
                                        </div>
                                    </div>
                                    @error('user_image')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">أسم المتخدم</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name}}" @if($user->id !== Auth::user()->id) disabled @endif required>
                                    <input type="hidden" class="form-control" name="id" value="{{ $user->id}}">
                                    @error('name')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">البريد الاليكتروني</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email}}" @if($user->id !== Auth::user()->id) disabled @endif required>
                                    @error('email')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">كلمة مرور</label>
                                    <input type="password" class="form-control" name="password" @if($user->id !== Auth::user()->id) disabled @endif required>
                                    @error('password')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">أعادة كلمة المرور</label>
                                    <input type="password" class="form-control" name="confirm-password" @if($user->id !== Auth::user()->id) disabled @endif required>
                                    @error('confirm-password')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">حالة المستخدم</label>
                                    <select class="form-control " name="status" required>
                                        <option >حالة المستخدم</option>
                                        <option @if($user->status == 0) selected @endif value="0">موقوف عن العمل</option>
                                        <option @if($user->status == 1) selected @endif value="1">مستمر في العمل</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">الصلاحيات</label>
                                    {!!  Form::select('roles_name[]',$roles,$userRole,array('class'=>'form-control select2','multiple','required')) !!}
                                    @error('roles_name')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">تحديث</button>
                                <a href="{{url('/'.$page='users')}}" class="btn btn-light">الغاء</a>
                            </div>
                        </div>
                    </form>
                </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
@endsection
