@extends('layouts.app')

@section('title')
    {{ $station->name }}&nbsp;Station
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
                                    <h5>{{ $station->name }} Station Details</h5>
                                </div>

                                <div class="card-block">
                                    <img src="{{ URL::asset('/build/stations/qr_codes/' . $station->qr_code) }}"
                                        alt="logo" height="150">
                                    </br>
                                    </br>
                                    <div class="row">

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station Name*</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Station Name" value="{{ $station->name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station Phone Number*</label>
                                                <input type="text" class="form-control" name="phone"
                                                    placeholder="Enter Station Phone Number" value="{{ $station->phone }}"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station District*</label>
                                                <input type="text" class="form-control" name="longitude"
                                                    placeholder="Enter Station Phone Number"
                                                    value="{{ $station->district_name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station Longitude*</label>
                                                <input type="text" class="form-control" name="longitude"
                                                    placeholder="Enter Station Phone Number"
                                                    value="{{ $station->longitude }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label class="form-label">Station Latitude*</label>
                                                <input type="text" class="form-control" name="latitude"
                                                    placeholder="Enter Station Phone Number"
                                                    value="{{ $station->latitude }}" readonly>
                                            </div>
                                        </div>

                                        @if (!empty($station->description))
                                            <div class="col-xl-3">
                                                <div class="form-group">
                                                    <label class="form-label">Description&nbsp;(optional)</label>
                                                    <textarea class="form-control" name="description" rows="1" value="{{ $station->description }}" readonly></textarea>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('stations.index') }}"><button
                                                class="btn btn-primary m-b-0">Back</button></a>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="col-sm-12">

                            <div class="card">
                                <div class="card-header">
                                    <h5>Ticket Checkers</h5>
                                </div>

                                <div class="card-block">

                                    <div class="mb-4">
                                        <a href="{{ route('stations.checker.create', ['id' => $station->id]) }}">
                                            <button
                                                class="btn btn-primary btn-round waves-effect waves-light float-right"><i
                                                    class="fa fa-plus-circle"></i>Add</button>
                                        </a>
                                    </div>
                                    <div class="dt-responsive table-responsive">

                                        <table id="base-style" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>address</th>
                                                    <th>Registed Date And Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ticket_checkers as $ticket_checker)
                                                    <tr>
                                                        <td>{{ $ticket_checker->id }}</td>
                                                        <td>{{ $ticket_checker->name }}</td>
                                                        <td>{{ $ticket_checker->email }}</td>
                                                        <td>{{ $ticket_checker->phone }}</td>
                                                        <td>{{ $ticket_checker->address }}</td>
                                                        <td>{{ $ticket_checker->created_at }}</td>
                                                        <td>
                                                            <div style="display: flex;">
                                                            <a
                                                                href="{{ route('stations.checker.history', ['station_id' => $station->id, 'id' => $ticket_checker->id]) }}">
                                                                <button
                                                                    class="btn btn-mat waves-effect waves-light btn-primary btn-sm">view
                                                                    history</button>
                                                            </a>
                                                            <form
                                                                action="{{ route('stations.checker.delete', $ticket_checker->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    onclick="return confirm('Are you sure?')"
                                                                    class="btn btn-mat waves-effect waves-light btn-danger btn-sm">Remove</button>
                                                            </form>
                                                            </div>
                                                        </td>
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
