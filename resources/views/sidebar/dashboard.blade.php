	<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title"> <span>Main</span> </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-dashboard"></i>
                            <span> Dashboard</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li class="{{ request()->routeIs('dashboard.admin') ? 'active' : '' }}"><a href="{{ route('dashboard.admin') }}" class="{{ Route::currentRouteNamed('dashboard.admin') ? 'active' : '' }}">Admin Dashboard</a></li>
                            <li class="{{ request()->routeIs('dashboard.employee') ? 'active' : '' }}"><a href="{{ route('dashboard.employee') }}" class="{{ Route::currentRouteNamed('dashboard.employee') ? 'active' : '' }}">Employee Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Employees</span> </li>
                    <li class="submenu">
                        {{-- <a href="#" class="noti-dot"> --}}
                        <a href="#" class="la la-dashboard">
                        <i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ request()->routeIs('all.employee.card') ? 'active' : '' }}"><a href="{{ route('all.employee.card') }}">All Employees</a></li>
                            <li class="{{ request()->routeIs('form.holidays') ? 'active' : '' }}"><a href="{{ route('form.holidays') }}">Holidays</a></li>
                            <li class="{{ request()->routeIs('form.leaves.new') ? 'active' : '' }}"><a href="{{ route('form.leaves.new') }}">Leaves (Admin) <!-- <span class="badge badge-pill bg-primary float-right">1</span> --></a></li>
                            <li class="{{ request()->routeIs('form.leaves.employee.new') ? 'active' : '' }}"><a href="{{ route('form.leaves.employee.new') }}">Leaves (Employee)</a></li>
                            <li class="{{ request()->routeIs('form.leavesettings.page') ? 'active' : '' }}"><a href="{{ route('form.leavesettings.page') }}">Leave Settings</a></li>
                            <li class="{{ request()->routeIs('attendance.page') ? 'active' : '' }}"><a href="{{ route('attendance.page') }}">Attendance (Admin)</a></li>
                            <li class="{{ request()->routeIs('attendance.employee.page') ? 'active' : '' }}"><a href="{{ route('attendance.employee.page') }}">Attendance (Employee)</a></li>
                            {{-- <li><a href="{{ route('departments') }}">Departments</a></li> --}}
                            {{-- <li><a href="{{ route('designations.page') }}">Designations</a></li> --}}
                            {{-- <li><a href="{{ route('timesheet.page') }}">Timesheet</a></li> --}}
                            {{-- <li><a href="{{ route('shift.scheduling.page') }}">Shift & Schedule</a></li> --}}
                            {{-- <li><a href="{{ route('overtime.page') }}">Overtime</a></li> --}}
                        </ul>
                    </li>
                    {{-- <li class="submenu"> <a href="#"><i class="la la-rocket"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="projects.html">Projects</a></li>
                            <li><a href="tasks.html">Tasks</a></li>
                            <li><a href="task-board.html">Task Board</a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>HR</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-files-o"></i> <span> Sales </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="estimates.html">Estimates</a></li>
                            <li><a href="invoices.html">Invoices</a></li>
                            <li><a href="payments.html">Payments</a></li>
                            <li><a href="expenses.html">Expenses</a></li>
                            <li><a href="provident-fund.html">Provident Fund</a></li>
                            <li><a href="taxes.html">Taxes</a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-files-o"></i> <span> Accounting </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="categories.html">Categories</a></li>
                            <li><a href="budgets.html">Budgets</a></li>
                            <li><a href="budget-expenses.html">Budget Expenses</a></li>
                            <li><a href="budget-revenues.html">Budget Revenues</a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="salary.html"> Employee Salary </a></li>
                            <li><a href="salary-view.html"> Payslip </a></li>
                            <li><a href="payroll-items.html"> Payroll Items </a></li>
                        </ul>
                    </li>
                    <li> <a href="policies.html"><i class="la la-file-pdf-o"></i> <span>Policies</span></a> </li>
                    <li class="submenu"> <a href="#"><i class="la la-pie-chart"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="expense-reports.html"> Expense Report </a></li>
                            <li><a href="invoice-reports.html"> Invoice Report </a></li>
                            <li><a href="payments-reports.html"> Payments Report </a></li>
                            <li><a href="project-reports.html"> Project Report </a></li>
                            <li><a href="task-reports.html"> Task Report </a></li>
                            <li><a href="user-reports.html"> User Report </a></li>
                            <li><a href="employee-reports.html"> Employee Report </a></li>
                            <li><a href="payslip-reports.html"> Payslip Report </a></li>
                            <li><a href="attendance-reports.html"> Attendance Report </a></li>
                            <li><a href="leave-reports.html"> Leave Report </a></li>
                            <li><a href="daily-reports.html"> Daily Report </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Performance</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-graduation-cap"></i> <span> Performance </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="performance-indicator.html"> Performance Indicator </a></li>
                            <li><a href="performance.html"> Performance Review </a></li>
                            <li><a href="performance-appraisal.html"> Performance Appraisal </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-crosshairs"></i> <span> Goals </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="goal-tracking.html"> Goal List </a></li>
                            <li><a href="goal-type.html"> Goal Type </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-edit"></i> <span> Training </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="training.html"> Training List </a></li>
                            <li><a href="trainers.html"> Trainers</a></li>
                            <li><a href="training-type.html"> Training Type </a></li>
                        </ul>
                    </li>
                    <li><a href="promotion.html"><i class="la la-bullhorn"></i> <span>Promotion</span></a></li>
                    <li><a href="resignation.html"><i class="la la-external-link-square"></i> <span>Resignation</span></a></li>
                    <li><a href="termination.html"><i class="la la-times-circle"></i> <span>Termination</span></a></li>
                    <li class="menu-title"> <span>Administration</span> </li>
                    <li> <a href="assets.html"><i class="la la-object-ungroup"></i> <span>Assets</span></a> </li>
                    <li class="submenu"> <a href="#"><i class="la la-briefcase"></i> <span> Jobs </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="user-dashboard.html"> User Dasboard </a></li>
                            <li><a href="jobs-dashboard.html"> Jobs Dasboard </a></li>
                            <li><a href="jobs.html"> Manage Jobs </a></li>
                            <li><a href="manage-resumes.html"> Manage Resumes </a></li>
                            <li><a href="shortlist-candidates.html"> Shortlist Candidates </a></li>
                            <li><a href="interview-questions.html"> Interview Questions </a></li>
                            <li><a href="offer_approvals.html"> Offer Approvals </a></li>
                            <li><a href="experiance-level.html"> Experience Level </a></li>
                            <li><a href="candidates.html"> Candidates List </a></li>
                            <li><a href="schedule-timing.html"> Schedule timing </a></li>
                            <li><a href="apptitude-result.html"> Aptitude Results </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Pages</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="profile.html"> Employee Profile </a></li>
                            <li><a href="client-profile.html"> Client Profile </a></li>
                        </ul>
                    </li> --}}
                    <li class="menu-title"><span>System</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-user"></i> <span>Settings</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('company.settings.page') }}" class="{{ Route::currentRouteNamed('company.settings.page') ? 'active' : '' }}">Company Information</a></li>
                            <li><a href="{{ route('roles.permissions.page') }}" class="{{ Route::currentRouteNamed('roles.permissions.page') ? 'active' : '' }}">Role Permission</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
	<!-- /Sidebar -->
