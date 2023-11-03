@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('css')
    <!-- tui charts css -->

    <link rel="stylesheet" href="{{ URL::asset('/build/libs/tui-chart/tui-chart.min.css') }}" type="text/css" media="all">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            <i class="fa fa-balance-scale bg-c-blue"></i>
        @endslot

        @slot('title')
            Terms & Policies
        @endslot

        @slot('description')
            Our Terms & Policies
        @endslot

        @slot('page_header')
            <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-balance-scale"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Terms & Policies</a> </li>
            </ul>
        @endslot
    @endcomponent

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    @include('../layouts/alert')
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="card">
                                <div class="card-header">
                                    <h5>Terms & Policies</h5>
                                </div>

                                <div class="card-block">
                                    <form method="post" action="{{ route('terms.policies.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <textarea id="elm1" name="description">{{ $terms_policies ? $terms_policies->description : '' }}</textarea>
                                        <br />
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script src="{{ URL::asset('/build/assets/pages/chart/float/jquery.flot.js') }} "></script>
    <script src="{{ URL::asset('/build/assets/pages/chart/float/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/pages/chart/float/curvedLines.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/pages/chart/float/jquery.flot.tooltip.min.js') }}"></script>

    <script src="{{ URL::asset('/build/bower_components/chartist/js/chartist.js') }}"></script>

    <script src="{{ URL::asset('/build/assets/pages/widget/amchart/amcharts.js') }} "></script>
    <script src="{{ URL::asset('/build/assets/pages/widget/amchart/serial.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/pages/widget/amchart/light.js') }}"></script>

    <script src="{{ URL::asset('/build/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/vertical/vertical-layout.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/build/assets/pages/dashboard/custom-dashboard.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ URL::asset('/build/assets/js/script.min.js') }}"></script>

    <script src="{{ URL::asset('build/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/js/pages/form-editor.init.js') }}"></script>
@endsection
