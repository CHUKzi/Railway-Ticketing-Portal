@extends('layouts.app')

@section('title')
Tickets Fares
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
            <i class="fa fa-industry bg-c-blue"></i>
        @endslot

        @slot('title')
        Tickets Fares
        @endslot

        @slot('description')
        Registered Tickets Fares
        @endslot

        @slot('page_header')
            <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ route('tickets.fares.index') }}"><i class="fa fa-industry"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('tickets.fares.index') }}">Tickets Fares</a> </li>
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
                                <a href="{{ route('tickets.fares.create') }}">
                                    <button class="btn btn-primary btn-round waves-effect waves-light float-right"><i class="fa fa-plus-circle"></i>Add Tickets Fares</button>
                                </a>
                            </div>
                            <div class="dt-responsive table-responsive">

                                <table class="table table-striped table-bordered nowrap base-style">
                                    <thead>
                                        <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>1 Class Price</th>
                                            <th>2 Class Price</th>
                                            <th>3 Class Price</th>
                                            <th>Added Date Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets_fares as $tickets_fare)
                                        <tr>
                                            <td>{{ $tickets_fare->from_station }}</td>
                                            <td>{{ $tickets_fare->to_station }}</td>
                                            <td>{{ $tickets_fare->class_1_price }}</td>
                                            <td>{{ $tickets_fare->class_2_price }}</td>
                                            <td>{{ $tickets_fare->class_3_price }}</td>
                                            <td>{{ $tickets_fare->added_date }}</td>
                                            <td>
                                                <form action="{{ route('tickets.fares.destroy', $tickets_fare->fares_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-mat waves-effect waves-light btn-danger btn-sm">Delete</button>
                                                </form>
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
