@extends('layouts.app')

@section('title')
    Create Train
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            Create Train
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
                                    <h5>Add Train Details</h5>
                                </div>
                                <div class="card-block">
                                    <div id="trainImage">
                                        <img src="{{ URL::asset('build/trains/images/no-image.png') }}" alt="Train Image"
                                            width="150">
                                    </div>
                                    <br>
                                    <form method="post" action="{{ route('trains.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Name of Train*</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Train Name">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Train Image (optional)</label>
                                                    <input type="file" class="form-control" name="image">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Train Weight-Tonnes (optional)</label>
                                                    <input type="number" class="form-control" name="weight"
                                                        placeholder="Enter Train Weight">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Year</label>
                                                    <input type="number" class="form-control" name="year"
                                                        placeholder="Enter Year">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Locomotives</label>
                                                    <input type="number" class="form-control" name="locomotives"
                                                        placeholder="Enter Locomotives">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Reporting Number</label>
                                                    <input type="text" class="form-control" name="reporting_number"
                                                        placeholder="Enter Reporting Number">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <div class="checkbox-zoom zoom-primary">
                                                        <label>
                                                            <input type="checkbox" name="class_1" value="1">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Class 1</span>
                                                        </label>
                                                        <br />

                                                        <label>
                                                            <input type="checkbox" name="class_2" value="1">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Class 2</span>
                                                        </label>
                                                        <br />
                                                        <label>
                                                            <input type="checkbox" name="class_3" value="1">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Class 3</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('trains.index') }}"><button type="button"
                                                    class="btn btn-danger m-b-0">Back</button></a>
                                            <button type="submit" class="btn btn-primary m-b-0">Create</button>
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
    <script>
        // Function to handle file input change
        function handleFileSelect(event) {
            const fileInput = event.target;
            const trainImage = document.getElementById('trainImage');
            const previewImage = trainImage.querySelector('img');

            // Check if a file was selected
            if (fileInput.files && fileInput.files[0]) {
                const file = fileInput.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Set the preview image source
                    previewImage.src = e.target.result;
                    previewImage.width = 150;
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(file);
            } else {
                // If no file is selected, display a placeholder image
                /*             previewImage.src = "{{ URL::asset('build/trains/images/no-image.png') }}";
                            previewImage.width = 150; */
            }
        }

        // Add an event listener to the file input
        const fileInput = document.querySelector('input[name="image"]');
        fileInput.addEventListener('change', handleFileSelect);
    </script>


    <script src="{{ URL::asset('/build/assets/pages/form-validation/validate.js') }}"></script>

    <script src="{{ URL::asset('/build/assets/pages/form-validation/form-validation.js') }}"></script>

    <script src="{{ URL::asset('/build/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/vertical/vertical-layout.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/script.js') }}"></script>
@endsection
