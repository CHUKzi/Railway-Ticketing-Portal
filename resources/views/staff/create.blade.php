@extends('layouts.app')

@section('title')
    Create Staff
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            Create Staff
        @endslot

        @slot('description')
            {{-- Registerd Stations --}}
        @endslot

        @slot('page_header')
            {{--             <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ route('stations.index') }}"><i class="fa fa-train"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('stations.index') }}">Stations</a> </li>
            </ul> --}}
        @endslot
    @endcomponent


    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">

                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                            @include('../layouts/alert')

                            <div class="card">
                                <div class="card-header">
                                    <h5>Staff Details</h5>
                                </div>
                                <div class="card-block">

                                    <form method="post" action="{{ route('staff.store') }}">
                                        @csrf
                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Role*</label>
                                                    <select class="form-control" name="role">
                                                        @foreach ($roles as $key => $role)
                                                            <option value="{{ $key }}">{{ $role }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Password*</label>
                                                    <input type="text" class="form-control" value="Random Password Protection : Enabled" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">First Name*</label>
                                                    <input type="text" class="form-control" name="first_name"
                                                        placeholder="Enter First Name">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Last Name*</label>
                                                    <input type="text" class="form-control" name="last_name"
                                                        placeholder="Enter Last Name">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email*</label>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Enter Email">
                                                </div>
                                            </div>


                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Mobile Number</label>
                                                    <input type="text" class="form-control" name="mobile"
                                                        placeholder="Enter Phone Number">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary m-b-0">Create</button>
                                        </div>
                                    </form>
                                    <a href="{{ route('staff.index') }}"><button
                                        class="btn btn-primary m-b-0">Back</button></a>

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
    <script src="{{ URL::asset('/build/assets/pages/form-validation/validate.js') }}"></script>

    <script src="{{ URL::asset('/build/assets/pages/form-validation/form-validation.js') }}"></script>

    <script src="{{ URL::asset('/build/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/vertical/vertical-layout.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/script.js') }}"></script>
@endsection
