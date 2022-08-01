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
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="card-header">
                        <h4 class="card-title">{{ $role->name }}</h4>
                        <div>
                            @can('أضافة صلاحية')
                                <a href="{{url('/'.$page='roles/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة صلاحية</a>
                            @endcan
                            @can('أضافة صلاحية')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info"><i class="las la-edit"></i> تعديل الصلاحية</a>
                            @endcan
                        </div>
                    </div>
                    <div class="basic-list-group">
                        <ul class="list-group">
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <li class="list-group-item">{{ $v->name }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
