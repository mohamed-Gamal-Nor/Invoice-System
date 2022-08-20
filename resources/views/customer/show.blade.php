@extends('layouts.master')
@section('title')
    {{$customer->name}}
@endsection
@section('css')
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{$customer->name}}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> العملاء</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='customer')}}">قائمة العملاء</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">{{$customer->name}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-xxl-4 col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <img class="img-fluid" src="{{URL::asset('/assets/images/svg/client.svg')}}" alt="">
                        <div class="card-body">
                            <h4 class="mb-0 text-center">{{$customer->name}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body">
                            <div class="media">
									<span class="mr-3">
										<i class="las la-map-marked-alt"></i>
									</span>
                                <div class="media-body text-white">
                                    <p class="mb-1"> عدد الاوردرات</p>
                                    <h3 class="text-white">{{number_format(0,2)}}</h3>
                                    <div class="progress mb-2 bg-secondary">
                                        <div class="progress-bar progress-animated bg-light" ></div>
                                    </div>
                                    <small></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="widget-stat card bg-secondary">
                        <div class="card-body">
                            <div class="media">
									<span class="mr-3">
										<i class="las la-shopping-bag"></i>
									</span>
                                <div class="media-body text-white">
                                    <p class="mb-1">عدد القطع </p>
                                    <h3 class="text-white">{{number_format(0,2)}}</h3>
                                    <div class="progress mb-2 bg-secondary">
                                        <div class="progress-bar progress-animated bg-light" style="width: {{number_format(0,2)}}%"></div>
                                    </div>
                                    <small>{{number_format(0,2)}}% </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-xxl-8 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">معلومات العميل</a></li>
                                <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link"> الاوردرات</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="about-me" class="tab-pane fade active show">
                                    <div class="profile-personal-info mt-2">
                                        <h4 class="text-primary mb-4">معلومات العميل</h4>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">اسم العميل <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$customer->name}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">رقم الهاتف الاول<span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$customer->phone_one}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">رقم الهاتف ثان<span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                @if(!empty($customer->phone_two))
                                                    <span>{{$customer->phone_two}}</span>
                                                @else
                                                    <span class="text-danger">لا يوجد رقم هاتف ثان</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">البريد الاليكتروني<span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                @if(!empty($customer->email))
                                                    <span>{{$customer->email}}</span>
                                                @else
                                                    <span class="text-danger">لا يوجد بريد اليكتروني</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">العنوان الاول<span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$customer->address_one}}</span></div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">العنوان التاني<span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                @if(!empty($customer->address_two))
                                                    <span>{{$customer->address_two}}</span>
                                                @else
                                                    <span class="text-danger">لا يوجد عنوان ثان</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">أنشأ بواسطة <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$customer->user->name}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">تاريخ الانشاء <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$customer->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">اخر تاريخ تعديل <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                @if(!empty($customer->updated_at))
                                                    <span>{{$customer->updated_at}}</span>
                                                @else
                                                    <span class="text-danger">لم يتم تعديل هذا العميل</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-skills pt-2 border-bottom-1 pb-2">
                                        <h4 class="text-primary mb-4">ملاحظات</h4>
                                        @if(empty($customer->description))
                                            <p class="text-primary">لا يوجد ملاحظات لعرضها</p>
                                        @else
                                            <p >{{$customer->description}}</p>

                                        @endif
                                    </div>
                                </div>
                                <div id="my-posts" class="tab-pane fade">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
