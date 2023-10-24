@extends('layouts.app')

@section('title')
    Create Package {{ $package->name }}
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            Edit Pakcage {{ $package->name }}
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
                                    <h5>Edit Package {{ $package->name }}</h5>
                                </div>
                                <div class="card-block">

                                    <form method="post" action="{{ route('packages.update', $package->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Pakcage Name*</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Package Name" value="{{ $package->name }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Credit Points*</label>
                                                    <input type="number" class="form-control" name="credit_points"
                                                        placeholder="Enter credit points" value="{{ $package->credit_points }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Package Price ({{ env('CURRENCY') }})*</label>
                                                    <input type="number" class="form-control" name="price"
                                                        placeholder="Enter credit points" value="{{ $package->price }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Discount Rate % (Optional)</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="This Option is comming soon" disabled>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary m-b-0">Update</button>
                                        </div>
                                    </form>

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
