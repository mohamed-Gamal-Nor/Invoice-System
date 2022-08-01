@extends('layouts.master')
@section('title')
    تعديل الصلاحيات
@endsection
@section('css')
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>تعديل صلاحية</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">صلاحيات المستخدمين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='roles/create')}}">تعديل صلاحية</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">تعديل صلاحية</h4>
                    @can('أضافة صلاحية')
                        <a href="{{url('/'.$page='roles/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة صلاحية</a>
                    @endcan
                </div>
                <div class="card-body">
                    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">أسم الصلاحية</label>
                                    {!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
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
                                                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
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
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
@endsection
