{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 --}}


 @extends('layouts.app')

 @section('title')
     Edit Profile
 @endsection

 @section('css')
 @endsection

 @section('content')
     @component('components.breadcrumb')
         @slot('icon')
             {{-- <i class="fa fa-train bg-c-blue"></i> --}}
         @endslot

         @slot('title')
             Edit Profile
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
                                     <h5>Chnage Password</h5>
                                 </div>
                                 <div class="card-block">

                                     <form method="post" action="{{ route('profile.password.update') }}">
                                        @csrf
                                        @method('put')
                                         <div class="row">

                                             <div class="col-xl-12">
                                                 <div class="form-group">
                                                     <label class="form-label">Current Password*</label>
                                                     <input type="password" class="form-control" name="current_password"
                                                         placeholder="Enter Current Password">
                                                 </div>
                                             </div>

                                             <div class="col-xl-12">
                                                 <div class="form-group">
                                                     <label class="form-label">New Password*</label>
                                                     <input type="password" class="form-control" name="password"
                                                         placeholder="Enter New Password">
                                                 </div>
                                             </div>

                                             <div class="col-xl-12">
                                                 <div class="form-group">
                                                     <label class="form-label">Confirm Password*</label>
                                                     <input type="password" class="form-control" name="password_confirmation"
                                                         placeholder="Enter Confirm Password">
                                                 </div>
                                             </div>

                                         </div>
                                         <div class="form-group">
                                             <button type="submit" class="btn btn-primary m-b-0">Update</button>
                                         </div>
                                     </form>
                                     <a href="{{ route('dashboard') }}"><button
                                         class="btn btn-primary m-b-0">Back</button></a>

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
 @endsection
