@extends('layouts.guest')

@section('title')
    Login
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
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
                                        @error('password')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit"
                                                class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

            </div>

        </section>
    @endsection
