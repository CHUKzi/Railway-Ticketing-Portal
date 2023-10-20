@extends('layouts.app')

@section('title')
    {{ $station->name }}&nbsp;Station
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            {{-- {{ $station->name }}&nbsp;Station --}}
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
                                    <h5>{{ $station->name }} Station Details</h5>
                                </div>

                                <div class="card-block">
                                    <img src="{{ URL::asset('/build/stations/qr_codes/'.$station->qr_code) }}" alt="logo" height="150">
                                </br>
                                </br>
                                    <div class="row">

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station Name*</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Station Name" value="{{ $station->name }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station Phone Number*</label>
                                                <input type="text" class="form-control" name="phone"
                                                    placeholder="Enter Station Phone Number" value="{{ $station->phone }}"
                                                    disabled>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station District*</label>
                                                <input type="text" class="form-control" name="longitude"
                                                    placeholder="Enter Station Phone Number"
                                                    value="{{ $station->district_name }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station Longitude*</label>
                                                <input type="text" class="form-control" name="longitude"
                                                    placeholder="Enter Station Phone Number"
                                                    value="{{ $station->longitude }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station Latitude*</label>
                                                <input type="text" class="form-control" name="latitude"
                                                    placeholder="Enter Station Phone Number"
                                                    value="{{ $station->latitude }}" disabled>
                                            </div>
                                        </div>

                                        @if (!empty($station->description))
                                            <div class="col-xl-3">
                                                <div class="form-group">
                                                    <label class="form-label">Description&nbsp;(optional)</label>
                                                    <textarea class="form-control" name="description" rows="1" value="{{ $station->description }}" disabled></textarea>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('stations.destroy', $station->id) }}" onclick="return confirm('Are you sure?')">
                                            <button class="btn btn-danger m-b-0">Delete</button>
                                        </a>

                                        <a href="{{ route('stations.index') }}"><button
                                                class="btn btn-primary m-b-0">Cancel</button></a>
                                    </div>

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
