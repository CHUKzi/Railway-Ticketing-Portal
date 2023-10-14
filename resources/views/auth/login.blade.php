@extends('layouts.guest')

@section('title')
    @lang('translation.Login')
@endsection

    @section('content')
        <section class="login-block">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">

                        <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="text-center">
                                <img src="{{ URL::asset('/build/assets/images/logo.png')}}" alt="logo.png" width="200">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center txt-primary">Sign In</h3>
                                        </div>
                                    </div>
                                    {{-- <p class="text-muted text-center p-b-5">Sign in with your regular account</p> --}}
                                    <div class="form-group form-primary">
                                        <input type="text" name="email" value="" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Username</label>
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value>
                                                    <span class="cr"><i
                                                            class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right float-right">
                                                <a href="auth-reset-password.html" class="text-right f-w-600"> Forgot
                                                    Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit"
                                                class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                        </div>
                                    </div>
                                    <p class="text-inverse text-left">Don't have an account?<a
                                            href="auth-sign-up-social.html"> <b>Register here </b></a>for free!</p>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

            </div>

        </section>
    @endsection
