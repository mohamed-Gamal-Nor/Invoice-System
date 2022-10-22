@extends('layouts.master')
@section('title')
    قائمة المستخدمين
@endsection
@section('css')
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>قائمة المستخدمين</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> المستخدمين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='users')}}">قائمة المستخدمين</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3">
                <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">عرض القائمة</a></li>
                <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">عرض شبكي</a></li>
            </ul>
        </div>
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">قائمة المستخدمين</h4>
                            @can('Users-create')
                                <a href="{{url('/'.$page='users/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة مستخدم</a>
                            @endcan

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example5" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>اسم المستخدم</th>
                                        <th>البريد الاليكتروني</th>
                                        <th>حالة التفعيل</th>
                                        <th>الصلاحيات</th>
                                        <th>الحالة</th>
                                        <th>تاريخ الانشاء</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users  as $key => $user)
                                        <tr>
                                            <td><img class="rounded-circle" width="35"
                                                     @if(empty($user->user_image))
                                                     src="{{URL::asset('assets/images/avatar/1.png')}}"
                                                     @else
                                                     src="{{asset('/storage/user_profile/'.$user->id .'/'. $user->user_image )}}"
                                                     @endif
                                                     alt="User Image"></td>
                                            <td>{{$user->name}}</td>
                                            <td><a href="javascript:void(0);"><strong>{{$user->email}}</strong></a></td>
                                            <td>
                                                @if($user->email_verified_at == null)
                                                    <span class="badge badge-rounded badge-warning">لم يتم التفعيل</span>
                                                @else
                                                    <span class="badge badge-rounded badge-primary"> تم التفعيل</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <span class="badge badge-rounded badge-success">{{ $v }}</span>
                                                    @endforeach
                                                @endif</td>
                                            <td>
                                                @if($user->status == null)
                                                    <span class="badge badge-rounded badge-danger">موقوف عن العمل</span>
                                                @else
                                                    <span class="badge badge-rounded badge-primary">مستمر في العمل</span>
                                                @endif
                                            </td>
                                            <td>{{$user->created_at->todatestring() }}</td>
                                            <td>
                                                @can('Users-edit')
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                @endcan
                                                @can('Users-delete')
                                                    <button type="button" data-user_id="{{ $user->id }}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#basicModal"><i class="la la-trash-o"></i></button>
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
                <div id="grid-view" class="tab-pane fade col-lg-12">
                    <div class="row">
                        @foreach($users  as $key => $user)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-header justify-content-end pb-0">
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <div class="profile-photo">
                                                <img
                                                    @if(empty($user->user_image))
                                                    src="{{URL::asset('assets/images/avatar/1.png')}}"
                                                    @else
                                                    src="{{asset('/storage/user_profile/'.$user->id .'/'. $user->user_image )}}"
                                                    @endif
                                                    width="100" class="img-fluid rounded-circle" alt="User Iamge">
                                            </div>
                                            <h3 class="my-4">{{$user->name}}</h3>
                                            <ul class="list-group mb-3 list-group-flush">
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">البريد الاليكتروني :</span><strong>{{$user->email}}</strong></li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">حالة التفعيل:</span>
                                                    @if($user->email_verified_at == null)
                                                        <span class="badge badge-rounded badge-warning">لم يتم التفعيل</span>
                                                    @else
                                                        <span class="badge badge-rounded badge-primary"> تم التفعيل</span>
                                                    @endif
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">الصلاحيات:</span>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $v)
                                                            <span class="badge badge-rounded badge-success">{{ $v }}</span>
                                                        @endforeach
                                                    @endif
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">الحالة:</span>
                                                    @if($user->status == null)
                                                        <span class="badge badge-rounded badge-danger">موقوف عن العمل</span>
                                                    @else
                                                        <span class="badge badge-rounded badge-primary">مستمر في العمل</span>
                                                    @endif
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">تاريخ الانشاء:</span><strong>{{$user->created_at->todatestring() }}</strong></li>
                                            </ul>
                                            @can('تعديل مستخدم')
                                                <a class="btn btn-outline-primary btn-rounded mt-3 px-4" href="{{ route('users.edit', $user->id) }}">تعديل المستخدم</a>
                                            @endcan
                                            @can('حذف مستخدم')
                                                <button type="button" data-user_id="{{ $user->id }}" class="btn btn-danger btn-rounded mt-3 px-4" data-toggle="modal" data-target="#basicModal">حذف المستخدم</button>
                                            @endcan

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="basicModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف المستخدم</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('users.destroy','test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    <input type="hidden" name="id" id="user_id" value="">
                    <div class="modal-body">

                        <p>هل تريد حذف المستخدم نهائيا؟ </p>
                        <p class="text-danger">ملحوظة : سوف يتم حذف جميع الحركات التي تخص هذا المستخدم. </p>
                        <p class="text-danger">يمكنك تعطيل المستخدم بدلا من حذفة</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">الغاء</button>
                        <button type="submit"  class="btn btn-danger">تاكيد الحذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Datatable -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins-init/datatables.init.js') }}"></script>
    <script>
        $('#basicModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var user_id = button.data('user_id')
            var modal = $(this)
            modal.find('#user_id').val(user_id);
        })
    </script>
@endsection
