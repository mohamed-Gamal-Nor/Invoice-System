@extends('layouts.master')
@section('title')
    أضافة صلاحية
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
    <div class="row" style="direction: rtl">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">أضافة صلاحية جديدة</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group text-right">
                                <label class="form-label">أسم الصلاحية</label>
                                <input type="text" class="form-control" name="name">
                                @error('name')
                                <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-header">
                            <h4 class="card-title text-danger">اختار الصلاحيات</h4>
                        </div>
                        <div class="table-responsive text-center col-10 m-auto">
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="35%">الجدول</th>
                                    <th width="20%">اضافة</th>
                                    <th width="20%">عرض</th>
                                    <th width="20%">تعديل</th>
                                    <th width="20%">حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;?>
                                @foreach($permissions as $permission)
                                    <?php $i++?>
                                    @php
                                        $sub_permissions = Spatie\Permission\Models\Permission::where('table',$permission->table)->get();
                                    @endphp
                                    <tr>
                                        <th>{{$i}}</th>
                                        <td>{{$permission->table}}</td>
                                        @if($sub_permissions->where('name',$permission->table.'-create')->first())
                                            <td>
                                                <div  class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="{{$permission->table.'-create'}}" value="{{$permission->table.'-create'}}" name="permission[]">

                                                </div>
                                            </td>
                                        @else
                                            <td>
                                            </td>
                                        @endif
                                        @if($sub_permissions->where('name',$permission->table.'-show')->first())
                                            <td>

                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="{{$permission->table.'-show'}}" value="{{$permission->table.'-show'}}" name="permission[]">
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                            </td>
                                        @endif
                                        @if($sub_permissions->where('name',$permission->table.'-edit')->first())
                                            <td>
                                                <div  class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="{{$permission->table.'-edit'}}" value="{{$permission->table.'-edit'}}" name="permission[]">
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                            </td>
                                        @endif
                                        @if($sub_permissions->where('name',$permission->table.'-delete')->first())
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="{{$permission->table.'-delete'}}" value="{{$permission->table.'-delete'}}"name="permission[]">
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @error('permission')
                            <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                            <a class="btn btn-danger" href="{{url('/'.$page='roles')}}">{{__('Cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
