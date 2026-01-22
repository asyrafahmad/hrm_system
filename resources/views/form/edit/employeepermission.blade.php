
@extends('layouts.app')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee Permission</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee / Edit Permission</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('employee.update.permission') }}" method="POST">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                <div class="row">
                                    <label class="col-form-label col-md-2">Employee ID</label>
                                    <div class="col-md-10">
                                        :<label class="col-form-label">&nbsp;{{ $employee->employee_code }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-md-2">Full Name</label>
                                    <div class="col-md-10">
                                        :<label class="col-form-label">&nbsp;{{ $employee->fullname ?? 'N/A' }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-md-2">Position</label>
                                    <div class="col-md-10">
                                        :<label class="col-form-label">&nbsp;{{ optional($employee->position)->name ?? 'N/A' }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-md-2">Department</label>
                                    <div class="col-md-10">
                                        :<label class="col-form-label">&nbsp;{{ optional($employee->department)->name ?? 'N/A' }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-md-2">Email</label>
                                    <div class="col-md-10">
                                        :<label class="col-form-label">&nbsp;{{ $employee->email ?? 'N/A' }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-md-2">Gender</label>
                                    <div class="col-md-10">
                                        :<label class="col-form-label">&nbsp;{{ $employee->gender ?? 'N/A' }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-md-2">Company</label>
                                    <div class="col-md-10">
                                        :<label class="col-form-label">&nbsp;{{ $employee->company ?? 'N/A' }}</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-form-label col-md-2">Employee Permission</label>
                                    <div class="col-md-10">
                                        <div class="table-responsive m-t-15">
                                            <table class="table table-striped custom-table">
                                                <thead>
                                                    <tr>
                                                        <th>Module</th>
                                                        <th class="text-center">Permission</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($rolePermissions as $items)
                                                        <tr>
                                                            <td>{{ $items }}</td>
                                                            <td class="text-center">
                                                                <input type="checkbox" id="check_permission_{{ $items }}" name="permissions[]" value="{{ $items }}" {{ in_array($items, $directPermissions->toArray()) ? 'checked' : '' }}>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label col-md-2"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
    @section('script')
    @endsection

@endsection
