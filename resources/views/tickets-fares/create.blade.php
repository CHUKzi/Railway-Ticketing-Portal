@extends('layouts.app')

@section('title')
    Create Tickets Fares
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            Create Tickets Fares
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
                                    <h5>Tickets Fares Details</h5>
                                </div>
                                <div class="card-block">

                                    <form method="post" action="{{ route('tickets.fares.store') }}">
                                        @csrf
                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">From Station*</label>
                                                    <select class="form-control" name="from_station_id">
                                                        <option value="">Select From Station</option>
                                                        @foreach ($stations as $station)
                                                            <option value="{{ $station->id }}">{{ $station->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">To Station*</label>
                                                    <select class="form-control" name="to_station_id">
                                                        <option value="">Select From To Station</option>
                                                        @foreach ($stations as $station)
                                                            <option value="{{ $station->id }}">{{ $station->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label class="form-label">1 Class Price*</label>
                                                    <input type="text" class="form-control" name="1_class_price"
                                                        placeholder="Enter 1 class ticket price fares">
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label class="form-label">2 Class Price*</label>
                                                    <input type="text" class="form-control" name="2_class_price"
                                                        placeholder="Enter 2 class ticket price fares">
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label class="form-label">3 Class Price*</label>
                                                    <input type="text" class="form-control" name="3_class_price"
                                                        placeholder="Enter 3 class ticket price fares">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary m-b-0">Create</button>
                                        </div>
                                    </form>
                                    <a href="{{ route('tickets.fares.index') }}"><button
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
