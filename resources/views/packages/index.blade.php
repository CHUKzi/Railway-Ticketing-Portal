@extends('layouts.app')

@section('title')
    Packages
@endsection

@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('/build/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('/build/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('/build/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            <i class="fa fa-shopping-cart bg-c-blue"></i>
        @endslot

        @slot('title')
            Packages
        @endslot

        @slot('description')
            Available Packages
        @endslot

        @slot('page_header')
            <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ route('packages.index') }}"><i class="fa fa-shopping-cart"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('packages.index') }}">Package</a> </li>
            </ul>
        @endslot
    @endcomponent


    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    @include('../layouts/alert')
                    <div class="card">
                        <div class="card-header">
                            <div class="mb-4">
                                <a href="{{ route('packages.create') }}">
                                    <button class="btn btn-primary btn-round waves-effect waves-light float-right"><i
                                            class="fa fa-plus-circle"></i>Add a new package</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        @foreach ($packages as $package)

                        <div class="col-xl-3 col-md-6">
                            <div class="card ticket-card">
                                <div class="card-body">
                                    <p class="m-b-30 bg-c-green lbl-card"><i class="fa fa-shopping-cart"></i> {{ $package->name }}
                                    </p>
                                    <div class="text-center">
                                        <h2 class="m-b-0 d-inline-block text-c-green">{{ $package->price }}</h2>
                                        <p class="m-b-0 d-inline-block">{{ env('CURRENCY') }}</p>
                                        <p class="m-b-0 m-t-15"><i
                                                class="fa fa-arrow-right m-r-10 f-18 text-c-green"></i>Credit Points
                                                {{ $package->credit_points }}</p>
                                        <br>

                                        <div style="display: flex;">
                                            {{-- <a href="">
                                                    <button class="btn btn-mat waves-effect waves-light btn-primary btn-sm">view</button>
                                                </a> --}}
                                            <a href="{{ route('packages.edit', $package->id) }}">
                                                <button
                                                    class="btn btn-mat waves-effect waves-light btn-warning btn-sm">Edit</button>
                                            </a>

                                            <form action="{{ route('packages.destroy', $package->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="btn btn-mat waves-effect waves-light btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>




                    {{-- </div> --}}

                </div>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ URL::asset('/build/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('/build/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}..">
    </script>
    <script src="{{ URL::asset('/build/assets/pages/data-table/js/jszip.min.js') }}.."></script>
    <script src="{{ URL::asset('/build/assets/pages/data-table/js/pdfmake.min.js') }}.."></script>
    <script src="{{ URL::asset('/build/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('/build/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('/build/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('/build/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('/build/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('/build/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>

    <script src="{{ URL::asset('/build/assets/pages/data-table/js/data-table-custom.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/vertical/vertical-layout.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/script.js') }}"></script>
@endsection
