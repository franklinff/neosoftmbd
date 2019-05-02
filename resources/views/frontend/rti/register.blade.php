@extends('frontend.layouts.app')
@section('body')
<div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1 m-login__wrapper h-100 light-bg">
    <!--begin::Head-->
    <!-- <div class="m-login__head">
        <span>Don't have an account?</span>
        <a href="#" class="m-link m--font-danger">Sign Up</a>
    </div> -->
    <!--end::Head-->

    <div class="m-login__logo m-login__logo--header transparent-bg no-shadow text-center">
        <a href="{{ url('/') }}">
            <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
        </a>
    </div>

    <!--begin::Body-->
    <div class="m-login__body">
        <!--begin::Signin-->
        <div class="m-login__container m-login__container--sign-in m-login__container--rounded-fields">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi">
                <div class="">
                    <div class="m-login__title text-center">
                        <h3>Register</h3>
                    </div>

                    <form class='m-login__form m-form form--small' id='rti_frontend_register' method="post" action="{{ route('rti_frontend.store') }}">
                        @csrf
                        <div class="form-group m-form__group">
                            <!-- <label for="" class="col-form-label">First Name</label> -->
                            <input class="form-control form-control--custom m-input" type="text" placeholder="Name of User"
                                name="name" value="{{old('name')}}">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                            <!-- <label for="" class="col-form-label">Mobile No</label> -->
                            <input class="form-control form-control--custom m-input" type="text" placeholder="Mobile No"
                                name="mobile_no" autocomplete="off" value="{{old('mobile_no')}}">
                                <span class="text-danger">{{$errors->first('mobile_no')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                            <!-- <label for="" class="col-form-label">Email Address</label> -->
                            <input class="form-control form-control--custom m-input" id="email_val" type="text"
                                placeholder="Email" name="email" autocomplete="off" value="{{old('email')}}">
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            <div class="error" id="email_error" style="display: none;">This Email-id is already used.</div>
                        </div>
                        <div class="form-group m-form__group">
                            <!-- <label for="" class="col-form-label">Pan Number</label> -->
                            <textarea class="form-control form-control--custom form-control--textarea m-input" name="address"
                                placeholder="Enter Address">{{old('address')}}</textarea>
                                <span class="text-danger">{{$errors->first('address')}}</span>
                        </div>
                        <!--begin::Action-->
                        <div class="m-login__action d-flex justify-content-between">
                        <a  href="{{route('rti_frontend.index')}}" class="btn btn-primary m-btn m-btn--pill m-btn--custom">
                            Back</a>
                            <!-- <a href="#" class="m-link">
                          
                        </a> -->
                            <button type="submit" id="m_login_signin_submit_rti_registration" class="btn btn-primary m-btn m-btn--pill m-btn--custom">Register</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
