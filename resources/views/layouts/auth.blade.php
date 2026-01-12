
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Dashboard') - HRMS</title>

     	<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">

		<!-- Main CSS -->
        <link defer rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    </head>
    <body>
        <style>
            .invalid-feedback{
                font-size: 14px;
            }
        </style>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Page Content -->
            @yield('content')
            <!-- /Page Content -->
        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script defer src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
		<!-- Select2 JS -->
		<script defer src="{{ URL::to('assets/js/select2.min.js') }}"></script>
		<!-- Custom JS -->
		<script defer src="{{ URL::to('assets/js/app.js') }}"></script>
