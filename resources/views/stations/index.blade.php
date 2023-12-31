@extends('layouts.app')

@section('title')
    Train Stations
@endsection

@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('/build/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('/build/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('/build/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/build/assets/icon/icofont/css/icofont.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('icon')
            <i class="fa fa-train bg-c-blue"></i>
        @endslot

        @slot('title')
            Train Stations
        @endslot

        @slot('description')
            Registered Stations
        @endslot

        @slot('page_header')
            <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ route('stations.index') }}"><i class="fa fa-train"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('stations.index') }}">Stations</a> </li>
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
                                <a href="{{ route('stations.create') }}">
                                    <button class="btn btn-primary btn-round waves-effect waves-light float-right"><i
                                            class="fa fa-plus-circle"></i>Add Station</button>
                                </a>
                            </div>
                            <div class="dt-responsive table-responsive">

                                <table class="table table-striped table-bordered nowrap base-style">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Teliphone</th>
                                            <th>Registerd Date</th>
                                            <th>District</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stations as $station)
                                            <tr>
                                                <td>{{ $station->id }}</td>
                                                <td>{{ $station->name }}</td>
                                                <td>{{ $station->phone }}</td>
                                                <td>{{ $station->created_at }}</td>
                                                <td>{{ $station->district_name }}</td>
                                                <td>
                                                    <div style="display: flex;">
                                                    <a href="{{ route('stations.view', $station->id) }}">
                                                        <button class="btn btn-mat waves-effect waves-light btn-primary btn-sm">view</button>
                                                    </a>

                                                    <a href="{{ route('stations.edit', $station->id) }}">
                                                        <button class="btn btn-mat waves-effect waves-light btn-warning btn-sm">Edit</button>
                                                    </a>

                                                    <form action="{{ route('stations.destroy', $station->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-mat waves-effect waves-light btn-danger btn-sm">Delete</button>
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
