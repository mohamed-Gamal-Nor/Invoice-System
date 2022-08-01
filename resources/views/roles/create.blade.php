@extends('layouts.master')
@section('title')
    أضافة مستخدم
@endsection
@section('css')

@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>أضافة صلاحية</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">صلاحيات المستخدمين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='roles/create')}}">أضافة صلاحية</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">أضافة صلاحية جديدة</h4>

                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">أسم الصلاحية</label>
                                    <input type="text" class="form-control" name="name">
                                    @error('name')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-header">
                                <h4 class="card-title">اختار الصلاحيات</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="basic-form">
                                    <div class="form-group">
                                        @foreach($permission as $value)
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input')) }}
                                                    {{ $value->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('permission')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">حفظ</button>
                                <a class="btn btn-danger" href="{{url('/'.$page='roles')}}">الغاء</a>
                            </div>
                        </div>
                    </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
