@extends('layouts.app')

@section('title')
    Users
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
            <i class="fa fa-users bg-c-blue"></i>
        @endslot

        @slot('title')
            Users
        @endslot

        @slot('description')
            Registerd Users
        @endslot

        @slot('page_header')
            <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ route('stations.index') }}"><i class="fa fa-users"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('stations.index') }}">Users</a> </li>
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

                                <table id="base-style" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Credit Points</th>
                                            <th>Account Status</th>
                                            <th>Last Login</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    {{ $user->first_name }}&nbsp;{{ $user->last_name }}<br/>
                                                    @foreach ($user->getRoleNames() as $role)
                                                        @if ($role === 'staff' || $role === 'admin' || $role === 'super admin')
                                                            <span class="badge badge-primary">{{ $role }}</span>
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->mobile ?: 'N/A' }}</td>
                                                <td>{{ number_format($user->credit_points, 2) ?: '0.00' }}</td>
                                                <td>
                                                    @if ($user->email_verified_at)
                                                        <label class="label label-info">Verified</label>
                                                    @else
                                                        <label class="label label-danger">Pending</label>
                                                    @endif
                                                </td>
                                                <td>{{ $user->last_login ?: 'Not yet' }}</td>
                                                <td>
                                                    <div style="display: flex;">
                                                        {{-- <a href="{{ route('users.view', $user->id) }}">
                                                    <button class="btn btn-mat waves-effect waves-light btn-primary btn-sm">view</button>
                                                </a> --}}
                                                        <form action="{{ route('users.destroy', $user->id) }}"
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
