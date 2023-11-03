@extends('layouts.app')

@section('title')
    Trains
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
            <i class="fa fa-train bg-c-blue"></i>
        @endslot

        @slot('title')
            Trains
        @endslot

        @slot('description')
            Registered Trains
        @endslot

        @slot('page_header')
            <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ route('stations.index') }}"><i class="fa fa-train"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('stations.index') }}">Trains</a> </li>
            </ul>
        @endslot
    @endcomponent


    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    @include('../layouts/alert')

                    <div class="card">
                        {{--                         <div class="card-header">
                            <h5>Base Style</h5>
                        </div>
 --}}
                        <div class="card-block">

                            <div class="mb-4">
                                <a href="{{ route('trains.create') }}">
                                    <button class="btn btn-primary btn-round waves-effect waves-light float-right"><i
                                            class="fa fa-plus-circle"></i>Add Train</button>
                                </a>
                            </div>

                            <div class="dt-responsive table-responsive">

                                <table class="table table-striped table-bordered nowrap base-style">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">ID</th>
                                            <th style="width: 10%">Image</th>
                                            <th style="width: 40%">Name</th>
                                            <th style="width: 10%">Class</th>
                                            <th style="width: 5%">Year</th>
                                            <th style="width: 5%">Weight</th>
                                            <th style="width: 10%">Locomotives</th>
                                            <th style="width: 10%">Reporting Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trains as $train)
                                            <tr>
                                                <td>{{ $train->id }}</td>
                                                <td>
                                                    @if ($train->image)
                                                        <img src="{{ URL::asset('build/trains/images/' . $train->image) }}"
                                                            alt="Train Image" width="100">
                                                    @else
                                                        <img src="{{ URL::asset('build/trains/images/no-image.png') }}"
                                                            alt="Train Image" width="100">
                                                    @endif
                                                </td>
                                                <td>{{ $train->name }}</td>
                                                <td>
                                                    @if ($train->class_1)
                                                        <p>1'st Class</p>
                                                    @endif
                                                    @if ($train->class_2)
                                                        <p>2'nd Class</p>
                                                    @endif
                                                    @if ($train->class_3)
                                                        <p>3'rd Class</p>
                                                    @endif
                                                    @if (!($train->class_1 || $train->class_2 || $train->class_3))
                                                        <i>Unknown</i>
                                                    @endif
                                                </td>
                                                <td>{{ $train->year }}</td>
                                                <td>
                                                    @if ($train->weight)
                                                        {{ $train->weight }} Tonnes
                                                    @else
                                                        <i>Unknown</i>
                                                    @endif
                                                </td>
                                                <td>{{ $train->locomotives }}</td>
                                                <td>{{ $train->reporting_number }}</td>
                                                <td>
                                                    <div style="display: flex;">

                                                        <a href="{{ route('trains.edit', $train->id) }}">
                                                            <button
                                                                class="btn btn-mat waves-effect waves-light btn-warning btn-sm">Edit</button>
                                                        </a>

                                                        <form action="{{ route('trains.destroy', $train->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                                class="btn btn-mat waves-effect waves-light btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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
