@extends('layouts.master')
@section('title')
    {{$shipping->name}}
@endsection
@section('css')
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{$shipping->name}}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> الشحن</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='shipping')}}">قائمة مناديب الشحن</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">{{$shipping->name}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-xxl-4 col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <img class="img-fluid" src="{{URL::asset('/assets/images/svg/shipping.svg')}}" alt="">
                        <div class="card-body">
                            <h4 class="mb-0 text-center">{{$shipping->name}}</h4>
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
                                    <p class="mb-1">عدد المناطق</p>
                                    <h3 class="text-white">{{$shipping->shippingArea->count()}}</h3>
                                    <div class="progress mb-2 bg-secondary">
                                        <div class="progress-bar progress-animated bg-light" style="width: {{$shipping->shippingArea->count() / 100}}%"></div>
                                    </div>
                                    <small>{{$shipping->shippingArea->count() /100}}% </small>
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
                                    <p class="mb-1">عدد الاوردرات المسلمة</p>
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
                <div class="col-lg-12">
                    <div class="widget-stat card bg-danger">
                        <div class="card-body">
                            <div class="media">
									<span class="mr-3">
										<i class="las la-shopping-basket"></i>
									</span>
                                <div class="media-body text-white">
                                    <p class="mb-1">عدد الاوردرات المرتجع</p>
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
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">معلومات</a></li>
                                <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link">بيانات الاوردرات</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="about-me" class="tab-pane fade active show">
                                    <div class="profile-personal-info mt-2">
                                        <h4 class="text-primary mb-4">معلومات المندوب</h4>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">اسم المندوب <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$shipping->name}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">رقم الهاتف <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$shipping->phone}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">أنشأ بواسطة <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$shipping->user->name}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">تاريخ الانشاء <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$shipping->created_at->todatestring() }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                <h5 class="f-w-500">اخر تاريخ تعديل <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$shipping->updated_at->todatestring() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-skills pt-2 border-bottom-1 pb-2">
                                        <h4 class="text-primary mb-4">ملاحظات</h4>
                                        @if(empty($shipping->description))
                                            <p class="text-primary">لا يوجد ملاحظات لعرضها</p>
                                        @else
                                            <p >{{$shipping->description}}</p>

                                        @endif
                                    </div>
                                    <div class="profile-skills pt-2 border-bottom-1 pb-2">
                                        <h4 class="text-primary mb-4">المناطق</h4>
                                        <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                                            <?php $i = 0;?>
                                            <table class="table table-bordered table-responsive-sm">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>مناطق الشحن</th>
                                                    <th>سعر الشحن</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($shipping->shippingArea as $key => $item)
                                                    <?php $i++?>
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{$item->areaName->name}}</td>
                                                        <td>{{$item->price}} EGP</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
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
