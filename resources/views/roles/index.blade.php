@extends('layouts.master')
@section('title')
    قائمة الصلاحيات
@endsection
@section('css')
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/toastr/css/toastr.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>قائمة الصلاحيات</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">صلاحيات المستخدمين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='roles')}}">قائمة الصلاحيات</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">قائمة الصلاحيات</h4>
                    @can('أضافة صلاحية')
                        <a href="{{url('/'.$page='roles/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة صلاحية</a>
                    @endcan

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>اسم الصلاحية</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('تعديل صلاحية')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                        @endcan
                                        @if ($role->name !== 'owner')
                                            @can('حذف صلاحية')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                $role->id], 'style' => 'display:inline']) !!}
                                                    {!!Form::button('<i class="la la-trash-o"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger'])!!}
                                                {!! Form::close() !!}
                                            @endcan
                                        @endif
                                        @can('عرض صلاحية')
                                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-success"><i class="la la-eye"></i></a>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Datatable -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins-init/datatables.init.js') }}"></script>

    @if (session()->has('success'))
        <script>
            toasterOptions();
            toastr.success("تم أضافة الصلاحية بنجاح");
        </script>
    @endif
@endsection
