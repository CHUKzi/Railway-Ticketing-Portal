@extends('layouts.app')

@section('title')
    {{ $user->first_name }}
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
            {{-- <i class="fa fa-train bg-c-blue"></i> --}}
        @endslot

        @slot('title')
            {{-- {{ $station->name }}&nbsp;Station --}}
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

                            <div class="card">
                                <div class="card-header">
                                    <h5>{{ $user->first_name }}'s Booking History</h5>
                                </div>

                                <div class="card-block">

{{--                                     <div class="mb-4">
                                        <a href="{{ route('stations.checker.create', ['id' => $station->id]) }}">
                                            <button
                                                class="btn btn-primary btn-round waves-effect waves-light float-right"><i
                                                    class="fa fa-plus-circle"></i>Add</button>
                                        </a>
                                    </div> --}}
                                    <div class="dt-responsive table-responsive">

                                        <table class="table table-striped table-bordered nowrap base-style">
                                            <thead>
                                                <tr>
                                                    <th>Receipt</th>
                                                    <th>Departure Station</th>
                                                    <th>Arrival Station</th>
                                                    <th>Class</th>
                                                    <th>Ticket Status</th>
                                                    <th>Ticket Price</th>
                                                    <th>Spend Points</th>
                                                    <th>Booked At</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->recipe }}</td>
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

                                    <div class="form-group">
                                        <a href="{{ route('stations.index') }}"><button
                                                class="btn btn-primary m-b-0">Back</button></a>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="row">


                        <div class="col-sm-12">

                            <div class="card">
                                <div class="card-header">
                                    <h5>{{ $user->first_name }}'s Payments History</h5>
                                </div>

                                <div class="card-block">

                                    <div class="dt-responsive table-responsive">

                                        <table class="table table-striped table-bordered nowrap base-style">
                                            <thead>
                                                <tr>
                                                    <th>Payment ID</th>
                                                    <th>Package Name</th>
                                                    <th>Package Price</th>
                                                    <th>Credit</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->payment_id }}</td>
                                                    <td>{{ $payment->package_name }}</td>
                                                    <td>{{ $payment->package_price }}</td>
                                                    <td>{{ number_format($payment->credit_points, 2) }}</td>
                                                    <td>{{ $payment->buy_time }}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group">
                                        <a href="{{ route('stations.index') }}"><button
                                                class="btn btn-primary m-b-0">Back</button></a>
                                    </div>

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

    <script src="{{ URL::asset('/build/assets/pages/form-validation/validate.js') }}"></script>

    <script src="{{ URL::asset('/build/assets/pages/form-validation/form-validation.js') }}"></script>

    <script src="{{ URL::asset('/build/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/vertical/vertical-layout.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ URL::asset('/build/assets/js/script.js') }}"></script>


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
@endsection
