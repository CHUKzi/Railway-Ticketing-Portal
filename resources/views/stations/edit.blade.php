@extends('layouts.app')

@section('title')
    Edit Train Station
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            Edit Train Station
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
                                    <h5>Update Station Details</h5>
                                </div>
                                <div class="card-block">

                                    <form method="post" action="{{ route('stations.update', $station->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Station Name*</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Station Name" value="{{ $station->name }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Station Phone Number*</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        placeholder="Enter Station Phone Number" value="{{ $station->phone }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Station District*</label>
                                                    <select class="form-control" name="district">
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}" {{ $station->district_id == $district->id ? 'selected':'' }}>{{ $district->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Station Longitude*</label>
                                                    <input type="text" class="form-control" name="longitude"
                                                        placeholder="Enter Station Phone Number" value="{{ $station->longitude }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Station Latitude*</label>
                                                    <input type="text" class="form-control" name="latitude"
                                                        placeholder="Enter Station Phone Number" value="{{ $station->latitude }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Description&nbsp;(optional)</label>
                                                    <textarea class="form-control" name="description" rows="1">{{ $station->description }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('stations.index') }}"><button type="button" class="btn btn-danger m-b-0">Cancel</button></a>
                                            <button type="submit" class="btn btn-primary m-b-0">Update</button>


                                        </div>
                                    </form>

                                   {{--  <a href="{{ route('stations.index') }}"><button class="btn btn-danger m-b-0">Cancel</button></a> --}}
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
