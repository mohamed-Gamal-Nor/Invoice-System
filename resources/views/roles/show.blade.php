@extends('layouts.master')
@section('title')
    عرض الصلاحية
@endsection
@section('css')
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>عرض صلاحية</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">صلاحيات المستخدمين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='roles/create')}}">عرض صلاحية</a></li>
            </ol>
        </div>
    </div>
    <div class="row" style="direction: rtl">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="card-header">
                        <h4 class="card-title">{{ $role->name }}</h4>
                        <div>
                            @can('Role-create')
                                <a href="{{url('/'.$page='roles/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة صلاحية</a>
                            @endcan
                            @can('Role-edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info"><i class="las la-edit"></i> تعديل الصلاحية</a>
                            @endcan
                            @can('Role-show')
                                <a href="{{ route('roles.index') }}" class="btn btn-success"><i class="las la-list"></i>قائمة الصلاحيات</a>
                            @endcan
                        </div>
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
                            @foreach($rolePermissions as $permission)
                                <?php $i++?>
                                @php
                                    $sub_permissions = Spatie\Permission\Models\Permission::where('table',$permission->table)->get();
                                @endphp
                                <tr>
                                    <th>{{$i}}</th>
                                    <td>{{$permission->table}}</td>
                                    @if($rolePermissions->where('name',$permission->table.'-create')->first())
                                        <td>
                                            @if($role->hasPermissionTo($permission->table.'-create'))
                                                <span class="fas fa-check font-2" style="color:green;"></span>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                        </td>
                                    @endif
                                    @if($sub_permissions->where('name',$permission->table.'-show')->first())
                                        <td>
                                            @if($role->hasPermissionTo($permission->table.'-show'))
                                                <span class="fas fa-check font-2" style="color:green;"></span>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                        </td>
                                    @endif
                                    @if($sub_permissions->where('name',$permission->table.'-edit')->first())
                                        <td>
                                            @if($role->hasPermissionTo($permission->table.'-edit'))
                                                <span class="fas fa-check font-2" style="color:green;"></span>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                        </td>
                                    @endif
                                    @if($sub_permissions->where('name',$permission->table.'-delete')->first())
                                        <td>
                                            @if($role->hasPermissionTo($permission->table.'-delete'))
                                                <span class="fas fa-check font-2" style="color:green;"></span>
                                            @endif
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
