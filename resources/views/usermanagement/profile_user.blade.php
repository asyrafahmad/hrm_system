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
                                            <img alt="" src="{{ URL::to('/assets/images/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->username }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h4 class="title">{{ Auth::user()->employee->fullname }} (Staff ID : {{ Auth::user()->employee->employee_code }})</h4>
                                                <h6 class="text-muted">Position: {{ Auth::user()->employee->positions }}</h6>
                                                <h6 class="text-muted">Department: {{ Auth::user()->employee->department->name ?? '-'}}</h6>
                                                <h6 class="text-muted">Date of Join : {{ Auth::user()->employee->join_date ?? '-' }}</h6>
                                                {{-- <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                    <li>
                                                        <div class="title">Phone:</div>
                                                        <div class="text">
                                                            @if(!empty(Auth::user()->employee->phone_number))
                                                            <a href="">{{ Auth::user()->employee->phone_number }}</a>
                                                            @else
                                                            N/A
                                                            @endif
                                                        </div>
                                                    </li>
                                                    <li>
                                                        @if(!empty(Auth::user()->employee->email))
                                                        <div class="title">Email:</div>
                                                        <div class="text"><a href="">{{ Auth::user()->employee->email }}</a></div>
                                                        @else
                                                        <div class="title">Email:</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if(!empty(Auth::user()->employee->profileInformation->birth_date))
                                                        <div class="title">Birthday:</div>
                                                        <div class="text">{{date('d F, Y',strtotime(Auth::user()->employee->profileInformation->birth_date)) }}</div>
                                                        @else
                                                        <div class="title">Birthday:</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if(!empty(Auth::user()->employee->profileInformation->address ))
                                                        <div class="title">Address:</div>
                                                        <div class="text">
                                                            @if(Auth::user()->employee->profileInformation->address != null)
                                                                {{ Auth::user()->employee->profileInformation->address }},
                                                                {{ Auth::user()->employee->profileInformation->postcode }},
                                                                {{ Auth::user()->employee->profileInformation->city }},
                                                                {{ Auth::user()->employee->profileInformation->state }},
                                                                {{ Auth::user()->employee->profileInformation->country }}
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
                                                        @if(!empty(Auth::user()->employee->gender))
                                                        <div class="title">Gender:</div>
                                                        <div class="text">{{ Auth::user()->employee->gender }}</div>
                                                        @else
                                                        <div class="title">Gender:</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <div class="title">Reports to:</div>
                                                        <div class="text">
                                                            @if(!empty(Auth::user()->employee->profileInformation->reports_to))
                                                                <div class="avatar-box">
                                                                    <div class="avatar avatar-xs">
                                                                        <img src="{{ URL::to('/assets/images/'. Auth::user()->employee->avatar) }}" alt="{{ Auth::user()->employee->profileInformation->reports_to }}">
                                                                    </div>
                                                                </div>
                                                                <a href="{{ route('profile_user.report_to', ['employee_id' => Auth::user()->employee->profileInformation->reports_to]) }}">
                                                                    @foreach ($employees as $employee)
                                                                        @if(Auth::user()->employee->profileInformation->reports_to === $employee->id)
                                                                            {{ $employee->fullname }}
                                                                        @endif
                                                                    @endforeach
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
                                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                            {{-- <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects</a></li> --}}
                            <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin Only)</small></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <!-- Profile Info Tab -->
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Personal Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Passport No.</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->passport_no)){{ Auth::user()->employee->profileInformation->passport_no }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Passport Exp Date.</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->passport_expired_date)){{ Auth::user()->employee->profileInformation->passport_expired_date }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Nationality</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->nationality))<a href="">{{ Auth::user()->employee->profileInformation->nationality }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Religion</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->religion))<a href="">{{ Auth::user()->employee->profileInformation->religion }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Marital status</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->marital_status))<a href="">{{ Auth::user()->employee->profileInformation->marital_status }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Employment of spouse</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->employment_of_spouse))<a href="">{{ Auth::user()->employee->profileInformation->employment_of_spouse }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">No. of children</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->no_of_children))<a href="">{{ Auth::user()->employee->profileInformation->no_of_children }}@else N\A @endif</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Emergency Contact <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h3>
                                    <h4 class="section-title">Primary</h4>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Name</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->emergency_contact_name_1)){{ Auth::user()->employee->profileInformation->emergency_contact_name_1 }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Relationship</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->emergency_contact_relationship_1)){{ Auth::user()->employee->profileInformation->emergency_contact_relationship_1 }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Mobile </div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->emergency_contact_mobile_1)){{ Auth::user()->employee->profileInformation->emergency_contact_mobile_1 }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Phone </div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->emergency_contact_phone_1)){{ Auth::user()->employee->profileInformation->emergency_contact_phone_1 }}@else N\A @endif</div>
                                        </li>
                                    </ul>
                                    <hr>
                                    <h4 class="section-title">Secondary</h4>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Name</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->emergency_contact_name_2)){{ Auth::user()->employee->profileInformation->emergency_contact_name_2 }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Relationship</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->emergency_contact_relationship_2)){{ Auth::user()->employee->profileInformation->emergency_contact_relationship_2 }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Mobile </div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->emergency_contact_mobile_2)){{ Auth::user()->employee->profileInformation->emergency_contact_mobile_2 }}@else N\A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Phone </div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->emergency_contact_phone_2)){{ Auth::user()->employee->profileInformation->emergency_contact_phone_2 }}@else N\A @endif</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Bank information <a href="#" class="edit-icon" data-toggle="modal" data-target="#bank_information_modal"><i class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Bank name</div>
                                            <div class="text">@if(!empty(Auth::user()->employee->profileInformation->bank_name)){{ Auth::user()->employee->profileInformation->bank_name }}@else N/A @endif</div>
                                        </li>
                                        <li>
                                            <div class="title">Bank account No.</div>
                                            <div class="number">@if(!empty(Auth::user()->employee->profileInformation->bank_account_no)){{ Auth::user()->employee->profileInformation->bank_account_no }}@else N/A @endif</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Family Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Relationship</th>
                                                    <th>Date of Birth</th>
                                                    <th>Phone</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>@if(!empty(Auth::user()->employee->profileInformation->family_member_name_1))@else @endif</td>
                                                    <td>@if(!empty(Auth::user()->employee->profileInformation->family_member_name_1)){{ Auth::user()->employee->profileInformation->family_member_name_1 }}@else @endif</td>
                                                    <td>@if(!empty(Auth::user()->employee->profileInformation->family_member_relationship_1)){{ Auth::user()->employee->profileInformation->family_member_relationship_1 }}@else @endif</td>
                                                    <td>@if(!empty(Auth::user()->employee->profileInformation->family_member_DOB_1)){{ Auth::user()->employee->profileInformation->family_member_DOB_1 }}@else @endif</td>
                                                    <td>@if(!empty(Auth::user()->employee->profileInformation->family_member_phone_1)){{ Auth::user()->employee->profileInformation->family_member_phone_1 }}@else @endif</td>
                                                    <td class="text-right">
                                                        @if(!empty(Auth::user()->employee->profileInformation->family_member_name_1))
                                                        <div class="dropdown dropdown-action">
                                                            <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                {{-- <a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a> --}}
                                                                <a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                        @else @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Education Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a></h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">@if(!empty(Auth::user()->employee->profileInformation->academic_institution_1)){{ Auth::user()->employee->profileInformation->academic_institution_1 }}@else Academic Institution 1 @endif</a>
                                                        <div>@if(!empty(Auth::user()->employee->profileInformation->academic_qualification_1)){{ Auth::user()->employee->profileInformation->academic_qualification_1 }}@else Academic Qualification 1 @endif</div>
                                                        <span class="time">@if(!empty(Auth::user()->employee->profileInformation->academic_starting_date_1)){{ Auth::user()->employee->profileInformation->academic_starting_date_1 }}@else N/A @endif - @if(!empty(Auth::user()->employee->profileInformation->academic_complete_date_1)){{ Auth::user()->employee->profileInformation->academic_complete_date_1 }}@else N/A @endif</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">@if(!empty(Auth::user()->employee->profileInformation->academic_institution_2)){{ Auth::user()->employee->profileInformation->academic_institution_2 }}@else Academic Institution 2 @endif</a>
                                                        <div>@if(!empty(Auth::user()->employee->profileInformation->academic_qualification_2)){{ Auth::user()->employee->profileInformation->academic_qualification_2 }}@else Academic Qualification 1 @endif</div>
                                                        <span class="time">@if(!empty(Auth::user()->employee->profileInformation->academic_starting_date_2)){{ Auth::user()->employee->profileInformation->academic_starting_date_2 }}@else N/A @endif - @if(!empty(Auth::user()->employee->profileInformation->academic_complete_date_2)){{ Auth::user()->employee->profileInformation->academic_complete_date_2 }}@else N/A @endif</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Experience <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a></h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @if(!empty(Auth::user()->employee->profileInformation->exp_company_name_1))
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">{{ Auth::user()->employee->profileInformation->exp_position_1 }} at {{ Auth::user()->employee->profileInformation->exp_company_name_1}}</a>
                                                        <span class="time">{{ Auth::user()->employee->profileInformation->exp_period_from_1 }} - {{ Auth::user()->employee->profileInformation->exp_period_to_1 }}</span>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            @if(!empty(Auth::user()->employee->profileInformation->exp_company_name_2))
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">{{ Auth::user()->employee->profileInformation->exp_position_2 }} at {{ Auth::user()->employee->profileInformation->exp_company_name_2 }}</a>
                                                        <span class="time">{{ Auth::user()->employee->profileInformation->exp_period_from_2 }} - {{ Auth::user()->employee->profileInformation->exp_period_to_2 }}</span>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Profile Info Tab -->

                <!-- Projects Tab -->
                {{-- <div class="tab-pane fade" id="emp_projects">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                        <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">Project Management</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">2</span> <span class="text-muted">open tasks, </span>
                                        <span class="text-xs">5</span> <span class="text-muted">tasks completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">Video Calling App</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">3</span> <span class="text-muted">open tasks, </span>
                                        <span class="text-xs">3</span> <span class="text-muted">tasks completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">Hospital Administration</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">12</span> <span class="text-muted">open tasks, </span>
                                        <span class="text-xs">4</span> <span class="text-muted">tasks completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- /Projects Tab -->

                <!-- Bank Statutory Tab -->
                <div class="tab-pane fade" id="bank_statutory">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"> Basic Salary Information</h3>
                            <form>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Salary basis <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select salary basis type</option>
                                                <option>Hourly</option>
                                                <option>Daily</option>
                                                <option>Weekly</option>
                                                <option>Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Salary amount <small class="text-muted">per month</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Type your salary amount" value="0.00">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Payment type</label>
                                            <select class="select">
                                                <option>Select payment type</option>
                                                <option>Bank transfer</option>
                                                <option>Check</option>
                                                <option>Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3 class="card-title"> PF Information</h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">PF contribution</label>
                                            <select class="select">
                                                <option>Select PF contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">PF No. <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select PF contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee PF rate</label>
                                            <select class="select">
                                                <option>Select PF contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select additional rate</option>
                                                <option>0%</option>
                                                <option>1%</option>
                                                <option>2%</option>
                                                <option>3%</option>
                                                <option>4%</option>
                                                <option>5%</option>
                                                <option>6%</option>
                                                <option>7%</option>
                                                <option>8%</option>
                                                <option>9%</option>
                                                <option>10%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total rate</label>
                                            <input type="text" class="form-control" placeholder="N/A" value="11%">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee PF rate</label>
                                            <select class="select">
                                                <option>Select PF contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select additional rate</option>
                                                <option>0%</option>
                                                <option>1%</option>
                                                <option>2%</option>
                                                <option>3%</option>
                                                <option>4%</option>
                                                <option>5%</option>
                                                <option>6%</option>
                                                <option>7%</option>
                                                <option>8%</option>
                                                <option>9%</option>
                                                <option>10%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total rate</label>
                                            <input type="text" class="form-control" placeholder="N/A" value="11%">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h3 class="card-title"> ESI Information</h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">ESI contribution</label>
                                            <select class="select">
                                                <option>Select ESI contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">ESI No. <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select ESI contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee ESI rate</label>
                                            <select class="select">
                                                <option>Select ESI contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select additional rate</option>
                                                <option>0%</option>
                                                <option>1%</option>
                                                <option>2%</option>
                                                <option>3%</option>
                                                <option>4%</option>
                                                <option>5%</option>
                                                <option>6%</option>
                                                <option>7%</option>
                                                <option>8%</option>
                                                <option>9%</option>
                                                <option>10%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total rate</label>
                                            <input type="text" class="form-control" placeholder="N/A" value="11%">
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bank Statutory Tab -->
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Profile Modal -->
        <div id="profile_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Profile Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.information.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-img-wrap edit-img">
                                        <img class="inline-block" src="{{ URL::to('/assets/images/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->username }}">
                                        <div class="fileupload btn">
                                            <span class="btn-text">edit</span>
                                            <input class="upload" type="file" id="image" name="images">
                                            {{-- <input type="hidden" name="hidden_image" id="e_image" value="{{ Auth::user()->avatar }}"> --}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ Auth::user()->employee->fullname }}">
                                                <input type="hidden" id="employee_id" name="employee_id" value="{{ Auth::user()->employee->id }}">
                                                <input type="hidden" id="email" name="email" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control datetimepicker" type="text" id="birth_date" name="birth_date" value="{{ !empty($information->birth_date) ? $information->birth_date : '' }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="" disabled {{ empty(Auth::user()->employee->gender) ? 'selected' : '' }}>Select Gender</option>
                                                    <option value="Male" {{ Auth::user()->employee->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ Auth::user()->employee->gender === 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        @if(Auth::user()->hasRole(['Super Admin','Admin','HR']))
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of Joining</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="join_date" name="join_date" value="{{ !empty(Auth::user()->employee->join_date) ? Auth::user()->employee->join_date : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ !empty(Auth::user()->employee->profileInformation->address) ? Auth::user()->employee->profileInformation->address : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ !empty(Auth::user()->employee->profileInformation->city) ? Auth::user()->employee->profileInformation->city : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ !empty(Auth::user()->employee->profileInformation->state) ? Auth::user()->employee->profileInformation->state : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>

                                        <select class="form-control" id="country" name="country">
                                            <option value="">-- Select Country --</option>

                                            @foreach (config('country') as $country)
                                                <option value="{{ $country }}"
                                                    {{ (!empty(Auth::user()->employee->profileInformation->country)
                                                        && Auth::user()->employee->profileInformation->country === $country)
                                                        ? 'selected' : '' }}>
                                                    {{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Post Code</label>
                                        <input type="number" class="form-control" id="postcode" name="postcode" value="{{ !empty(Auth::user()->employee->profileInformation->postcode) ? Auth::user()->employee->profileInformation->postcode : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{ !empty(Auth::user()->employee->phone_number) ? Auth::user()->employee->phone_number : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select class="form-control" id="department" name="department">
                                            <option value="" disabled {{ empty($employee->department_id) ? 'selected' : '' }}>Select Department</option>
                                            @foreach ($departments as $id => $name)
                                                <option value="{{ $id }}" {{ $employee->department_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation <span class="text-danger">*</span></label>
                                        <select class="form-control" name="position">
                                            <option value="" disabled {{ empty($employee->position_id) ? 'selected' : '' }}>Select Designation</option>
                                            @foreach ($positions as $id => $name)
                                                <option value="{{ $id }}" {{ $employee->position_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if(Auth::user()->hasRole(['Super Admin','Admin','HR']))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Reports To <span class="text-danger">*</span></label>
                                            <select class="form-control" id="reports_to" name="reports_to">
                                                <option value="" disabled {{ empty(Auth::user()->employee->profileInformation->reports_to) ? 'selected' : '' }}>Select Manager</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}" {{ optional(Auth::user()->employee->profileInformation)->reports_to == $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->fullname }}, ({{ $employee->employee_code }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- /Profile Modal -->

        <!-- Personal Info Modal -->
        <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.personal_information.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="employee_id" value="{{ Auth::user()->employee->id }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="passport_no">Passport No</label>
                                        <input type="text" class="form-control" id="passport_no" name="passport_no" value="{{ !empty(Auth::user()->employee->profileInformation->passport_no) ? Auth::user()->employee->profileInformation->passport_no : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="passport_expired_date">Passport Expiry Date</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker" id="passport_expired_date" name="passport_expired_date" value="{{ !empty($information->passport_expired_date) ? $information->passport_expired_date : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationality">
                                            Nationality <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-control" id="nationality" name="nationality" required>
                                            <option value="">-- Select Nationality --</option>

                                            @foreach (config('country') as $nationality)
                                                <option value="{{ $nationality }}"
                                                    {{ (!empty(Auth::user()->employee->profileInformation->nationality) && Auth::user()->employee->profileInformation->nationality === $nationality) ? 'selected' : '' }}>
                                                    {{ $nationality }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion">Religion</label>

                                        <select class="form-control" id="religion" name="religion">
                                            <option value="">-- Select Religion --</option>

                                            @foreach (config('religious') as $religion)
                                                <option value="{{ $religion }}"
                                                    {{ (!empty(Auth::user()->employee->profileInformation->religion) && Auth::user()->employee->profileInformation->religion === $religion) ? 'selected' : '' }}>
                                                    {{ $religion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marital_status">
                                            Marital Status <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-control" id="marital_status" name="marital_status" required>
                                            <option value="">-- Select Marital Status --</option>

                                            @foreach (config('marital_status') as $status)
                                                <option value="{{ $status }}"
                                                    {{ (!empty(Auth::user()->employee->profileInformation->marital_status) && Auth::user()->employee->profileInformation->marital_status === $status) ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employment_of_spouse">Employment of Spouse</label>
                                        <select class="form-control" id="employment_of_spouse" name="employment_of_spouse">
                                            <option value="Yes" {{ !empty(Auth::user()->employee->profileInformation->employment_of_spouse) && Auth::user()->employee->profileInformation->employment_of_spouse == 'Yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="No" {{ !empty(Auth::user()->employee->profileInformation->employment_of_spouse) && Auth::user()->employee->profileInformation->employment_of_spouse == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_of_children">No. of Children</label>
                                        <input type="number" min="0" class="form-control" id="no_of_children" name="no_of_children" value="{{ !empty(Auth::user()->employee->profileInformation->no_of_children) ? Auth::user()->employee->profileInformation->no_of_children : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- /Personal Info Modal -->

        <!-- Family Info Modal -->
        <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Family Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.family_information.save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee->id }}">
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Family Member 1

                                            <a href="javascript:void(0);" class="delete-icon">
                                                <i class="fa fa-trash-o">** TODO: DELETE FUNCTION **</i>
                                            </a>
                                        </h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" id="family_member_name_1" name="family_member_name_1" value="{{ !empty(Auth::user()->employee->profileInformation->family_member_name_1) ? Auth::user()->employee->profileInformation->family_member_name_1 : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="family_member_relationship_1" name="family_member_relationship_1">
                                                        <option value="" disabled selected>Select Relationship</option>
                                                        @foreach(config('relationship') as $relationship)
                                                            <option value="{{ $relationship }}" {{ Auth::user()->employee->profileInformation->family_member_relationship_1 == $relationship ? 'selected' : '' }}>{{ $relationship }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="family_member_DOB_1" name="family_member_DOB_1" value="{{ !empty(Auth::user()->employee->profileInformation->family_member_DOB_1) ? Auth::user()->employee->profileInformation->family_member_DOB_1 : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="number" id="family_member_phone_1" name="family_member_phone_1"  value="{{ !empty(Auth::user()->employee->profileInformation->family_member_phone_1) ? Auth::user()->employee->profileInformation->family_member_phone_1 : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        ** TODO : ADD MORE FAMILY INFORMATION **
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Family Info Modal -->

        <!-- Emergency Contact Modal -->
        <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.emergency_contact.save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee->id }}">
                            @if(!empty(Auth::user()->employee->profileInformation))
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Primary Contact</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="emergency_contact_name_1" name="emergency_contact_name_1" value="{{ !empty(Auth::user()->employee->profileInformation->emergency_contact_name_1) ? Auth::user()->employee->profileInformation->emergency_contact_name_1 : '' }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="relationship" name="relationship">
                                                        <option value="" disabled {{ empty(optional(Auth::user()->employee->profileInformation)->emergency_contact_relationship_1) ? 'selected' : '' }}>
                                                            Select Relationship
                                                        </option>

                                                        @foreach (config('relationship') as $relationship)
                                                            <option value="{{ $relationship }}"
                                                                {{ optional(Auth::user()->employee->profileInformation)->emergency_contact_relationship_1 == $relationship ? 'selected' : '' }}>
                                                                {{ $relationship }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="number" id="emergency_contact_mobile_1" name="emergency_contact_mobile_1" value="{{ !empty(Auth::user()->employee->profileInformation->emergency_contact_mobile_1) ? Auth::user()->employee->profileInformation->emergency_contact_mobile_1 : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control" type="number" id="emergency_contact_phone_1" name="emergency_contact_phone_1" value="{{ !empty(Auth::user()->employee->profileInformation->emergency_contact_phone_1) ? Auth::user()->employee->profileInformation->emergency_contact_phone_1 : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Secondary Contact</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="emergency_contact_name_2" name="emergency_contact_name_2" value="{{ !empty(Auth::user()->employee->profileInformation->emergency_contact_name_2) ? Auth::user()->employee->profileInformation->emergency_contact_name_2 : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="emergency_contact_relationship_2" name="emergency_contact_relationship_2">
                                                        <option value="" disabled {{ empty(optional(Auth::user()->employee->profileInformation)->emergency_contact_relationship_2) ? 'selected' : '' }}>
                                                            Select Relationship
                                                        </option>

                                                        @foreach (config('relationship') as $relationship)
                                                            <option value="{{ $relationship }}"
                                                                {{ optional(Auth::user()->employee->profileInformation)->emergency_contact_relationship_2 == $relationship ? 'selected' : '' }}>
                                                                {{ $relationship }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="number" id="emergency_contact_mobile_2" name="emergency_contact_mobile_2" value="{{ !empty(Auth::user()->employee->profileInformation->emergency_contact_mobile_2) ? Auth::user()->employee->profileInformation->emergency_contact_mobile_2 : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control" type="number" id="emergency_contact_phone_2" name="emergency_contact_phone_2" value="{{ !empty(Auth::user()->employee->profileInformation->emergency_contact_phone_2) ? Auth::user()->employee->profileInformation->emergency_contact_phone_2 : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Emergency Contact Modal -->

        <!-- Bank Information Modal -->
        <div id="bank_information_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bank Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.bank_information.save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Bank Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bank Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="bank_name" name="bank_name" value="@if(!empty(Auth::user()->employee->profileInformation->bank_name)){{ Auth::user()->employee->profileInformation->bank_name }}@endif">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bank Account No <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="bank_account_no" name="bank_account_no" value="@if(!empty(Auth::user()->employee->profileInformation->bank_account_no)){{ Auth::user()->employee->profileInformation->bank_account_no }}@endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bank Information Modal -->

        <!-- Education Modal -->
        <div id="education_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Education Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-header">
                        <h5 class="title">(Highest to Lowest)</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.education_information.save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee->id }}">
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o">** TODO: DELETE FUNCTION **</i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" class="form-control floating" id="academic_institution_1" name="academic_institution_1" value="@if(!empty(Auth::user()->employee->profileInformation->academic_institution_1)){{ Auth::user()->employee->profileInformation->academic_institution_1 }}@endif">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" class="form-control floating" id="academic_qualification_1" name="academic_qualification_1" value="@if(!empty(Auth::user()->employee->profileInformation->academic_qualification_1)){{ Auth::user()->employee->profileInformation->academic_qualification_1 }}@endif">
                                                    <label class="focus-label">Academic Qualification</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" class="form-control floating" id="academic_type_qualification_1" name="academic_type_qualification_1" value="@if(!empty(Auth::user()->employee->profileInformation->academic_type_qualification_1)){{ Auth::user()->employee->profileInformation->academic_type_qualification_1 }}@endif">
                                                    <label class="focus-label">Type of Qualification</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" class="form-control floating" id="academic_grade_1" name="academic_grade_1" value="@if(!empty(Auth::user()->employee->profileInformation->academic_grade_1)){{ Auth::user()->employee->profileInformation->academic_grade_1 }}@endif">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" id="academic_starting_date_1" name="academic_starting_date_1" value="@if(!empty(Auth::user()->employee->profileInformation->academic_starting_date_1)){{ Auth::user()->employee->profileInformation->academic_starting_date_1 }}@endif">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" id="academic_complete_date_1" name="academic_complete_date_1" value="@if(!empty(Auth::user()->employee->profileInformation->academic_complete_date_1)){{ Auth::user()->employee->profileInformation->academic_complete_date_1 }}@endif">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"> ** TODO: DELETE FUNCTION **</i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" class="form-control floating" id="academic_institution_2" name="academic_institution_2" value="@if(!empty(Auth::user()->employee->profileInformation->academic_institution_2)){{ Auth::user()->employee->profileInformation->academic_institution_2 }}@endif">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" class="form-control floating" id="academic_qualification_2" name="academic_qualification_2" value="@if(!empty(Auth::user()->employee->profileInformation->academic_qualification_2)){{ Auth::user()->employee->profileInformation->academic_qualification_2 }}@endif">
                                                    <label class="focus-label">Academic Qualification</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" class="form-control floating" id="academic_type_qualification_2" name="academic_type_qualification_2" value="@if(!empty(Auth::user()->employee->profileInformation->academic_type_qualification_2)){{ Auth::user()->employee->profileInformation->academic_type_qualification_2 }}@endif">
                                                    <label class="focus-label">Type of Qualification</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" class="form-control floating" id="academic_grade_2" name="academic_grade_2" value="@if(!empty(Auth::user()->employee->profileInformation->academic_grade_2)){{ Auth::user()->employee->profileInformation->academic_grade_2 }}@endif">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" id="academic_starting_date_21" name="academic_starting_date_2" value="@if(!empty(Auth::user()->employee->profileInformation->academic_starting_date_2)){{ Auth::user()->employee->profileInformation->academic_starting_date_2 }}@endif">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" id="academic_complete_date_2" name="academic_complete_date_2" value="@if(!empty(Auth::user()->employee->profileInformation->academic_complete_date_2)){{ Auth::user()->employee->profileInformation->academic_complete_date_2 }}@endif">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More ** TODO : ADD MORE EDUCATION INFORMATION **</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Education Modal -->

        <!-- Experience Modal -->
        <div id="experience_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Experience Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.experience_information.save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee->id }}">
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations 1<a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o">** TODO: DELETE FUNCTION **</i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" id="exp_company_name_1" name="exp_company_name_1" value="@if(!empty(Auth::user()->employee->profileInformation->exp_company_name_1 )){{ Auth::user()->employee->profileInformation->exp_company_name_1 }}@endif">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" id="exp_location_1" name="exp_location_1"  value="@if(!empty(Auth::user()->employee->profileInformation->exp_location_1 )){{ Auth::user()->employee->profileInformation->exp_location_1 }}@endif">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" id="exp_position_1" name="exp_position_1"  value="@if(!empty(Auth::user()->employee->profileInformation->exp_position_1 )){{ Auth::user()->employee->profileInformation->exp_position_1 }}@endif">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" id="exp_period_from_1" name="exp_period_from_1"  value="@if(!empty(Auth::user()->employee->profileInformation->exp_period_from_1 )){{ Auth::user()->employee->profileInformation->exp_period_from_1 }}@endif">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" id="exp_period_to_1" name="exp_period_to_1" value="@if(!empty(Auth::user()->employee->profileInformation->exp_period_to_1 )){{ Auth::user()->employee->profileInformation->exp_period_to_1 }}@endif">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations 2<a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o">** TODO: DELETE FUNCTION **</i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" id="exp_company_name_2" name="exp_company_name_2" value="@if(!empty(Auth::user()->employee->profileInformation->exp_company_name_2 )){{ Auth::user()->employee->profileInformation->exp_company_name_2 }}@endif">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" id="exp_location_2" name="exp_location_2"  value="@if(!empty(Auth::user()->employee->profileInformation->exp_location_2 )){{ Auth::user()->employee->profileInformation->exp_location_2 }}@endif">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" id="exp_position_2" name="exp_position_2" value="@if(!empty(Auth::user()->employee->profileInformation->exp_position_2 )){{ Auth::user()->employee->profileInformation->exp_position_2 }}@endif">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" id="exp_period_from_2" name="exp_period_from_2" value="@if(!empty(Auth::user()->employee->profileInformation->exp_period_from_2 )){{ Auth::user()->employee->profileInformation->exp_period_from_2 }}@endif">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" id="exp_period_to_2" name="exp_period_to_2" value="@if(!empty(Auth::user()->employee->profileInformation->exp_period_to_2 )){{ Auth::user()->employee->profileInformation->exp_period_to_2 }}@endif">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle">** TODO: ADD MORE EXPERIENCE FUNCTION **</i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Experience Modal -->

        <!-- /Page Content -->
    </div>
@endsection
