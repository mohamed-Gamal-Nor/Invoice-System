
@extends('layouts.master')
@section('title')
    DashBoard
@endsection
@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if (session('resent'))
                <div class="col-xl-12 col-xxl-12">
                    <div class="alert alert-secondary alert-dismissible alert-alt solid fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                        <strong>Success!</strong> {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                </div>
            @endif
            <div class="col-xl-12">
                <div class="alert alert-primary left-icon-big alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>
                    <div class="media">
                        <div class="alert-left-icon-big">
                            <span><i class="mdi mdi-email-alert"></i></span>
                        </div>
                        <div class="media-body">
                            <h6 class="mt-1 mb-1">{{ __('Verify Your Email Address') }} !</h6>
                            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                            <p>{{ Auth()->user()->email }}</p>
                            <p>{{ __('If you did not receive the email') }},</p>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-light btn-sm text-primary">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection


