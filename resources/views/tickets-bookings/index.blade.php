@extends('layouts.app')

@section('title')
    Ticket Booking
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
            <i class="feather icon-calendar bg-c-blue"></i>
        @endslot

        @slot('title')
            Ticket Booking
        @endslot

        @slot('description')
            All Ticket Booking
        @endslot

        @slot('page_header')
            <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ route('stations.index') }}"><i class="feather icon-calendar"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('stations.index') }}">Ticket Booking</a> </li>
            </ul>
        @endslot
    @endcomponent


    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">

                    <div class="card">
                        {{--                         <div class="card-header">
                            <h5>Base Style</h5>
                        </div>
 --}}
                        <div class="card-block">

                            <div class="dt-responsive table-responsive">

                                <table class="table table-striped table-bordered nowrap base-style">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Receipt</th>
                                            <th>User</th>
                                            <th>Departure Station</th>
                                            <th>Arrival Station</th>
                                            <th>Class</th>
                                            <th>Status</th>
                                            <th>Ticket Price</th>
                                            <th>Spent Points</th>
                                            <th>Booked At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->booking_id }}</td>
                                            <td>{{ $booking->recipe }}</td>
                                            <td>{{ $booking->username }}</td>
                                            <td>{{ $booking->departure_station }}</td>
                                            <td>{{ $booking->arrival_station }}</td>
                                            <td>{{ $booking->class }}</td>
                                            <td>
                                                @if($booking->booking_status ==='active')
                                                <label class="label label-info">{{ $booking->booking_status }}</label>
                                                @else
                                                <label class="label label-success">{{ $booking->booking_status }}</label>
                                                @endif
                                            </td>
                                            <td>{{ $booking->price }}</td>
                                            <td>{{ $booking->spent_points }}</td>
                                            <td>{{ $booking->booked_at }}</td>
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
