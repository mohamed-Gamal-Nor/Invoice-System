@extends('layouts.master')
@section('title')
    تعديل مورد / {{$supplier->name}}
@endsection
@section('css')
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>تعديل مورد / {{$supplier->name}}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> الموردين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='users/create')}}">تعديل مورد</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">تعديل مورد / {{$supplier->name}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">تعديل مورد / {{$supplier->name}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('supplier.update','test') }}" enctype="multipart/form-data" method="POST">
                        {{ method_field('patch') }}
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">أسم المورد*</label>
                                    <input type="text" class="form-control" name="name" value="{{$supplier->name}}">
                                    <input type="hidden" class="form-control" name="id" value="{{$supplier->id}}">
                                    @error('name')
                                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">*رقم الهاتف</label>
                                    <input type="tel" class="form-control" name="phone" value="{{$supplier->phone}}">
                                    @error('phone')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">العنوان</label>
                                    <input type="text" class="form-control" name="address" value="{{$supplier->address}}">
                                    @error('address')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">رصيد بداية المدة</label>
                                    <input type="number" class="form-control" name="start_balance" value="{{$supplier->start_balance}}">
                                    @error('start_balance')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">حالة المورد</label>
                                    <select class="form-control " name="status">
                                        <option >حالة المورد</option>
                                        <option value="0" @if($supplier->status == 0) selected @endif>موقوف عن العمل</option>
                                        <option value="1" @if($supplier->status == 1) selected @endif>مستمر في العمل</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">ملاحظات</label>
                                    <textarea class="form-control" rows="4" name="description">{{$supplier->description}}</textarea>
                                    @error('description')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                                <a href="{{url('/'.$page='supplier')}}" class="btn btn-light">{{__('Cancel')}}</a>
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
