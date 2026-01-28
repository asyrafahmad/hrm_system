<!-- Employee Page Header Component -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title ?? 'Employee' }}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item {{ request()->routeIs('all.employee.card') ? 'active' : '' }}">
                    {{ $breadcrumbLabel ?? 'Employee' }}
                </li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee">
                <i class="fa fa-plus"></i> Add Employee
            </a>
            <div class="view-icons">
                <a href="{{ route('all.employee.card') }}"
                   class="grid-view btn btn-link {{ request()->routeIs('all.employee.card') ? 'active' : '' }}"
                   title="Grid View">
                    <i class="fa fa-th"></i>
                </a>
                <a href="{{ route('all.employee.list') }}"
                   class="list-view btn btn-link {{ request()->routeIs('all.employee.list') ? 'active' : '' }}"
                   title="List View">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Add Employee Modal -->
<div id="add_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('all.employee.save') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="employee_code" name="employee_code" value="{{ $employee_code }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="email" name="email" placeholder="example@gmail.com">
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Birth Date <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate">
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">IC Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ic_number" name="ic_number" placeholder="IC Number">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="019*******">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="gender" name="gender">
                                    <option value="">-- Select --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Department <span class="text-danger">*</span></label>
                                <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="department" name="department">
                                    <option value="">-- Select --</option>
                                    @foreach ($all_department as $key => $dept )
                                        <option value="{{ $dept->name }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Position <span class="text-danger">*</span></label>
                                <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="position" name="position">
                                    <option value="">-- Select --</option>
                                    @foreach ($all_position as $key => $pos )
                                        <option value="{{ $pos->name }}">{{ $pos->name }}</option>
                                    @endforeach
                                </select>
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
<!-- /Add Employee Modal -->
