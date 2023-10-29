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
            <i class="feather icon-home bg-c-blue"></i>
        @endslot

        @slot('title')
            Dashboard
        @endslot

        @slot('description')
            Summary of System
        @endslot

        @slot('page_header')
            <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html"><i class="feather icon-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Dashboard</a> </li>
            </ul>
        @endslot
    @endcomponent

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    @include('../layouts/alert')
                    <div class="row">

                        <div class="col-md-3">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Registered Users</h6>
                                            <h3 class="f-w-700 text-c-blue">{{ $count_users }}</h3>
                                            {{-- <p class="m-b-0"></p> --}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-users bg-c-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Registered Stations</h6>
                                            <h3 class="f-w-700 text-c-green">{{ $count_stations }}</h3>
                                            {{-- <p class="m-b-0"></p> --}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-train bg-c-green"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Back Office Staff</h6>
                                            <h3 class="f-w-700 text-c-yellow">{{ $count_back_office_staff }}</h3>
                                            {{-- <p class="m-b-0"></p> --}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-sitemap bg-c-yellow"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Total Active Booking</h6>
                                            <h3 class="f-w-700 text-c-yellow">{{ $count_booking }}</h3>
                                            {{-- <p class="m-b-0"></p> --}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas feather icon-calendar bg-c-red"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="card">
                                <div class="card-header">
                                    <h5>Last 7 Days Booking</h5>
                                </div>
                                <div class="card-block">
                                    <center>
                                        <div id="booking_chart" style="width: auto; height: 400px;"></div>
                                    </center>

                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="card">
                                <div class="card-header">
                                    <h5>Last 7 Days Payments</h5>
                                </div>
                                <div class="card-block">
                                    <center>
                                        <div id="payment_chart" style="width: auto; height: 400px;"></div>
                                    </center>

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
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var chartData = {!! $last7_days_booking_data !!}; // Parse the chart data from the PHP variable

      var data = google.visualization.arrayToDataTable(chartData);

      var options = {
        chart: {
          title: '',
          subtitle: '',
        }
      };

      var chart = new google.charts.Bar(document.getElementById('booking_chart'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var chartData = {!! $last7_days_payment_data !!}; // Parse the chart data from the PHP variable

      var data = google.visualization.arrayToDataTable(chartData);

      var options = {
        chart: {
          title: '',
          subtitle: '',
        }
      };

      var chart = new google.charts.Bar(document.getElementById('payment_chart'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>


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
@endsection
