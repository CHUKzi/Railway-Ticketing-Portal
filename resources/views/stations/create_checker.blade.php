@extends('layouts.app')

@section('title')
    Create Checker
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            Create Checker
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
                                    <h5>Add Checker Details</h5>
                                </div>
                                <div class="card-block">

                                    <form method="post" action="{{ route('stations.checker.store') }}">
                                        @csrf
                                        <input type="hidden" name="station_id" value="{{ $station->id }}">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Station Name*</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Name" value="{{ $station->name }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Name*</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Name">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Phone Number*</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        placeholder="Enter Phone Number">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email*</label>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Enter Email Number">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Password*</label>
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Enter Password Number">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Address*</label>
                                                    <textarea class="form-control" name="address" rows="1"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary m-b-0">Create</button>
                                        </div>
                                    </form>
                                    <a href="{{ route('stations.view', ['id' => $station->id]) }}"><button
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
