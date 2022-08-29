@extends('layouts.master')
@section('title')
    فواتير المشتريات
@endsection
@section('css')
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>فواتير المشتريات</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">حساب الموردين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='invoices')}}">فواتير المشتريات</a></li>
            </ol>
        </div>
    </div>
    <livewire:invoices />
@endsection
@section('script')
@endsection
