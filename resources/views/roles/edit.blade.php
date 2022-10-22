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
    <div class="row" style="direction: rtl">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">تعديل صلاحية</h4>
                    <div>
                        @can('Role-create')
                            <a href="{{url('/'.$page='roles/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة صلاحية</a>
                        @endcan
                        @can('Role-show')
                            <a href="{{ route('roles.index') }}" class="btn btn-success"><i class="las la-list"></i>قائمة الصلاحيات</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">أسم الصلاحية</label>
                                    {!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="card-header">
                                <h4 class="card-title  text-danger">اختار الصلاحيات</h4>
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
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="{{$permission->table.'-create'}}" value="{{$permission->table.'-create'}}" @if(isset($role)&&$role->hasPermissionTo($permission->table.'-create')) checked @endif name="permission[]">
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                </td>
                                            @endif
                                            @if($sub_permissions->where('name',$permission->table.'-show')->first())
                                                <td>

                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="{{$permission->table.'-show'}}" value="{{$permission->table.'-show'}}" @if(isset($role)&&$role->hasPermissionTo($permission->table.'-show')) checked @endif name="permission[]">
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                </td>
                                            @endif
                                            @if($sub_permissions->where('name',$permission->table.'-edit')->first())
                                                <td>
                                                    <div  class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="{{$permission->table.'-edit'}}" value="{{$permission->table.'-edit'}}" @if(isset($role)&&$role->hasPermissionTo($permission->table.'-edit')) checked @endif name="permission[]">
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                </td>
                                            @endif
                                            @if($sub_permissions->where('name',$permission->table.'-delete')->first())
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="{{$permission->table.'-delete'}}" value="{{$permission->table.'-delete'}}" @if(isset($role)&&$role->hasPermissionTo($permission->table.'-delete')) checked @endif name="permission[]">
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
                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                                <a class="btn btn-danger" href="{{url('/'.$page='roles')}}">{{__('Cancel')}}</a>
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
