@extends('layouts.master')
@section('title')
    قائمة الصلاحيات
@endsection
@section('css')

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
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
                        <a href="{{url('/'.$page='roles/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة صلاحية</a>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>اسم الصلاحية</th>
                                <th>عدد الصلاحيات</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php $i =0;?>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td> {{$role->permissions->count()}}</td>
                                    <td>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>


                                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-success"><i class="la la-eye"></i></a>
                                        @if ($role->name !== 'owner')
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                            $role->id], 'style' => 'display:inline']) !!}
                                            {!!Form::button('<i class="la la-trash-o"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger'])!!}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <div class="col-12">
                        </div>

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
@endsection
