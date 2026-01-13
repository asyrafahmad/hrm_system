
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Dashboard') - HRMS</title>

     	<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">

        {{-- <link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}"> --}}
{{--
        <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
        <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
        @yield('css') --}}
    </head>
    <body>
        <style>
            .invalid-feedback{
                font-size: 14px;
            }
        </style>
		<!-- Main Wrapper -->
        <div class="main-wrapper">

            <!-- Header -->
            @include('header.index')
            <!-- /Header -->

            <!-- Sidebar -->
            @include('sidebar.dashboard')
            <!-- /Sidebar -->

            <!-- Page Content -->
            @yield('content')
            <!-- /Page Content -->

        </div>
		<!-- /Main Wrapper -->
		<!-- jQuery -->
        <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
		<!-- Bootstrap Core JS -->
        <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
        <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
        <!-- Slimscroll JS -->
		<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
		<!-- Select2 JS -->
		<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
		<!-- Datetimepicker JS -->
		<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
		<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		<!-- Custom JS -->
		<script src="{{ URL::to('assets/js/app.js') }}"></script>
