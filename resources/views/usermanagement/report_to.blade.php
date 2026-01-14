@extends('layouts.app')
@section('content')

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- /Page Header -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#">
                                            <img alt="" src="{{ URL::to('/assets/images/'. $employees->avatar) }}" alt="{{ $employees->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h4 class="title">{{ $employees->name }} (Staff ID : {{ $employees->employee_code }})</h4>
                                                <h6 class="text-muted">Position: {{ $employees->position }}</h6>
                                                <h6 class="text-muted">Department: {{ $employees->department }}</h6>
                                                <h6 class="text-muted">Date of Join : {{ $employees->join_date }}</h6>
                                                {{-- <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                    <li>
                                                        <div class="title">Phone:</div>
                                                        <div class="text">
                                                            @if(!empty($employees->phone_number))
                                                            <a href="">{{ $employees->phone_number }}</a>
                                                            @else
                                                            N/A
                                                            @endif
                                                        </div>
                                                    </li>
                                                    <li>
                                                        @if(!empty($employees->email))
                                                        <div class="title">Email:</div>
                                                        <div class="text"><a href="">{{ $employees->email }}</a></div>
                                                        @else
                                                        <div class="title">Email:</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if(!empty($employees->birth_date))
                                                        <div class="title">Birthday:</div>
                                                        <div class="text">{{date('d F, Y',strtotime($employees->birth_date)) }}</div>
                                                        @else
                                                        <div class="title">Birthday:</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if(!empty($profile_information->address))
                                                        <div class="title">Address:</div>
                                                        <div class="text">
                                                            @if($profile_information->address != null)
                                                                {{ $profile_information->address . ', ' . $profile_information->postcode . ', ' . $profile_information->city . ', ' . $profile_information->state . ', ' . $profile_information->country }}
                                                            @else
                                                                <br>
                                                            @endif
                                                        </div>
                                                        @else
                                                        <div class="title">Address:</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if(!empty($employees->gender))
                                                        <div class="title">Gender:</div>
                                                        <div class="text">{{ $employees->gender }}</div>
                                                        @else
                                                        <div class="title">Gender:</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <div class="title">Reports to:</div>
                                                        <div class="text">
                                                            @if(!empty($profile_information->reports_to))
                                                                <div class="avatar-box">
                                                                    <div class="avatar avatar-xs">
                                                                        <img src="{{ URL::to('/assets/images/'. $employees->avatar) }}" alt="{{ $profile_information->reports_to }}">
                                                                    </div>
                                                                </div>
                                                                <a href="{{ route('profile_user.report_to', ['employee_id' => $profile_information->reports_to]) }}">
                                                                    {{ $profile_information->reports_to }}
                                                                </a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </div>
                                                    </li>
                                            </ul>
                                        </div>
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
