@extends('layouts.app')

@section('title')
    Edit Train
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            Edit Train
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
                                    <h5>#{{ $train->id }} - {{ $train->name }} - Edit Train Details</h5>
                                </div>
                                <div class="card-block">
                                    <div id="trainImage">
                                        @if ($train->image)
                                            <img src="{{ URL::asset('build/trains/images/' . $train->image) }}"
                                                alt="Train Image" width="150">
                                        @else
                                            <img src="{{ URL::asset('build/trains/images/no-image.png') }}"
                                                alt="Train Image" width="150">
                                        @endif
                                    </div>
                                    <br>
                                    <form method="POST" action="{{ route('trains.update', $train->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">


                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Name of Train*</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Train Name" value="{{ $train->name }}">
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
                                                    <label class="form-label">Year</label>
                                                    <input type="text" class="form-control" name="year"
                                                        placeholder="Enter Year" value="{{ $train->year }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Train Weight-Tonnes (optional)</label>
                                                    <input type="text" class="form-control" name="weight"
                                                        placeholder="Enter Weight" value="{{ $train->weight }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Locomotives*</label>
                                                    <input type="text" class="form-control" name="locomotives"
                                                        placeholder="Enter Locomotives" value="{{ $train->locomotives }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Reporting Number*</label>
                                                    <input type="text" class="form-control" name="reporting_number"
                                                        placeholder="Enter Reporting Number"
                                                        value="{{ $train->reporting_number }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">

                                                    <div class="checkbox-zoom zoom-primary">
                                                        <label>
                                                            <input type="checkbox" name="class_1" value="{{ $train->class_1 }}" {{ $train->class_1 ? 'checked' : '' }}>
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>1 Class</span>
                                                        </label>
                                                    </div>
                                                    <br />

                                                    <div class="checkbox-zoom zoom-primary">
                                                        <label>
                                                            <input type="checkbox" name="class_2" value="{{ $train->class_2 }}" {{ $train->class_2 ? 'checked' : '' }}>
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>2 Class</span>
                                                        </label>
                                                    </div>
                                                    <br />

                                                    <div class="checkbox-zoom zoom-primary">
                                                        <label>
                                                            <input type="checkbox" name="class_3" value="{{ $train->class_3 }}" {{ $train->class_3 ? 'checked' : '' }}>
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>3 Class</span>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('trains.index') }}"><button type="button"
                                                    class="btn btn-danger m-b-0">Cancel</button></a>
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
