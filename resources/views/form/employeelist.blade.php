@extends('layouts.app')
@section('content')


    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            @include('form.add.addemployee', ['title' => 'Employee', 'breadcrumbLabel' => 'Employee'])
            <!-- /Page Header -->

            <!-- Search Filter -->
            {{-- <form action="{{ route('all.employee.list.search') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="employee_id">
                            <label class="focus-label">Employee ID</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Employee Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Position</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="sumit" class="btn btn-success btn-block"> Search </button>
                    </div>
                </div>
            </form> --}}
            <!-- Search Filter -->
            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th class="text-nowrap">Join Date</th>
                                    <th>Department</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee )
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ route('profile.employee', $employee->id) }}" class="avatar">
                                                <img alt="" src="{{ asset('assets/images/' . $employee->avatar) }}">
                                            </a>
                                            <a href="{{ route('profile.employee', $employee->id) }}">{{ $employee->fullname }}<span>{{ optional($employee->position)->name }}</span></a>
                                        </h2>
                                    </td>
                                    <td>{{ $employee->employee_code }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone_number }}</td>
                                    <td>{{ $employee->join_date }}</td>
                                    <td>{{ optional($employee->department)->name }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('employee.edit.permission', $employee->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit Permission</a>
                                                <a class="dropdown-item" href="{{ url('all/employee/delete/'.$employee->id)}}"onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
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
        <!-- /Page Content -->


    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $("input:checkbox").on('click', function()
        {
            var $box = $(this);
            if ($box.is(":checked"))
            {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            }
            else
            {
                $box.prop("checked", false);
            }
        });
    </script>
    <script>
        // select auto id and email
        $('#name').on('change',function()
        {
            $('#employee_id').val($(this).find(':selected').data('employee_id'));
            $('#email').val($(this).find(':selected').data('email'));
        });
    </script>
    @endsection
@endsection
