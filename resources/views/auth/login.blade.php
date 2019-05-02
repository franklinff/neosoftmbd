@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2"
    id="m_login" style="position: relative;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 overlay overlay--login h-100vh">
                <div class="d-flex justify-content-center align-items-center login-page-header">
                    <img class="login-logo" src="{{asset('/img/logo-short.png')}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                    <div class="d-flex flex-wrap">
                        <div class="text-center w-100 m-login--left-box">
                            <h4 class="text-uppercase">Mumbai Housing and Area Development Board</h4>
                        </div>
                        <div class="m-login__container m-login--right-box">
                            <div class="m-login__signin m-login__signin--box">
                                <div class="m-login__head">
                                    <!-- <h1 class="m-login__title mb-0 display-4">
                                        Sign In
                                    </h1> -->
                                    <p class="sub-title">
                                        @if (session('registered'))
                                        <div class="alert alert-success">
                                            <div class="text-center">{{ session('registered') }}</div>
                                        </div>
                                        @endif
                                    </p>
                                </div>
                                @if(Session::has('error'))
                                <div class="alert alert-danger alert-block" style="margin-top: 14px;">
                                    <strong>{{Session::get('error')}}</strong>
                                </div>
                                @endif
                                <form class="m-login__form m-form" id="mhadaUser" name="sign_in_form" method="post"
                                    action="{{route('loginUser')}}">
                                    @csrf
                                    <div class="form-group m-form__group">
                                        <!-- <label for="" class="col-form-label">Email Address</label> -->
                                        <input class="form-control form-control-icon form-control-icon--email m-input" type="email" placeholder="Email" name="email"
                                            value="{{ old('email') }}" autocomplete="off">
                                    </div>
                                    <div class="form-group m-form__group position-relative">
                                        <!-- <label for="" class="col-form-label">Password</label> -->
                                        <input class="form-control form-control-icon form-control-icon--password m-input" type="password" placeholder="Password" name="password"
                                            autocomplete="off" id="password-field">
                                        <!-- <span toggle="#password-field" class="fa fa-fw fa-eye hide-show-pwd toggle-password"></span> -->
                                    </div>
                                    <div class="m-login__form-sub m-login__forgot">
                                        <a href="{{ route('password.request') }}" class="m-link text-dark">
                                            Forgot Password ?
                                        </a>
                                    </div>
                                    <div class="form-group m-form__group" style="margin-top: 16px;">
                                        <div class="d-flex position-relative justify-content-between">
                                            <i class="fa fa-refresh" onclick="document.getElementById('captcha_img').src='{{ URL::to('captcha') }}'; return false"
                                                title="Recapture" aria-hidden="true" style="font-size: 24px;cursor: pointer;"></i>
                                            <span class="captcha-wrapper"> <img id="captcha_img" src="{{URL::to('captcha')}}"></span>
                                            <input type="text" id="captcha" class="form-control mt-0" name="captcha"
                                                placeholder="Captcha">
                                            @if($errors->has('captcha'))
                                            <span class="help-block captcha-input-error" style="color: red;">Invalid
                                                Captcha
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <button id="mhada-user" class="btn btn-block btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">
                                        Sign In
                                    </button>
                                </form>
                            </div>

                            {{--<div class="m-login__forget-password">
                                <div class="m-login__head">
                                    <h1 class="m-login__title mb-0 display-4">
                                        Forgotten Password ?
                                    </h1>
                                </div>
                                <form class='m-login__form m-form' id='society_forgot_password_form' method="post"
                                    action="{{ route('society_offer_letter_forgot_password') }}">
                                    @csrf
                                    <div class="form-group m-form__group">
                                        <!-- <label for="" class="col-form-label">Enter your email to reset your password :</label> -->
                                        <input class="form-control m-input" type="email" placeholder="Email Address"
                                            name="society_email">
                                    </div>
                                    <div class="m-login__form-action">
                                        <button id="m_login_forget_password_submit_society_offer_letter" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primaryr">
                                            Request
                                        </button>
                                        &nbsp;&nbsp;
                                        <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">
                                            <i class="la la-close"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
