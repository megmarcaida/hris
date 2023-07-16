@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Role</h1>
                        <a href="{{ route('adm/role')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit role</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <form action="{{ route('adm/edit-role')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 offset-3 mb-3 mb-sm-0">
                                        <input type="hidden" class="form-control form-control-user" name="id" value="{{ $role->id }}">
                                        <input type="text" class="form-control form-control-user" name="name" value="{{ $role->name }}"
                                            placeholder="Role name">
                                        <br>
                                        <select type="text" style="padding:0px !important; border-radius:0px;height:400px;" class="form-control form-control-user" required multiple placeholder="select status" name="permissions[]">
                                            <?php $rd = explode(',',$role->permissions); ?>
                                            
                                                @if(in_array("administration",$rd))
                                                    <option value="administration" selected>Administration</option>
                                                @else
                                                    <option value="administration">Administration</option>
                                                @endif

                                                @if(in_array("department",$rd))
                                                    <option value="department" selected>Department</option>
                                                @else
                                                    <option value="department">Department</option>
                                                @endif

                                                @if(in_array("designation",$rd))
                                                    <option value="designation" selected>Designation</option>
                                                @else
                                                    <option value="designation">Designation</option>
                                                @endif

                                                @if(in_array("branch",$rd))
                                                    <option value="branch" selected>Branch</option>
                                                @else
                                                    <option value="branch">Branch</option>
                                                @endif

                                                @if(in_array("manage_employee",$rd))
                                                    <option value="manage_employee" selected>Manage Employee</option>
                                                @else
                                                    <option value="manage_employee">Manage Employee</option>
                                                @endif

                                                @if(in_array("apply_for_leave",$rd))
                                                    <option value="apply_for_leave" selected>Apply for Leave</option>
                                                @else
                                                    <option value="apply_for_leave">Apply for Leave</option>
                                                @endif
                                            
                                                @if(in_array("leave_requested_application",$rd))
                                                    <option value="leave_requested_application" selected>Leave Requested Application</option>
                                                @else
                                                    <option value="leave_requested_application">Leave Requested Application</option>
                                                @endif
                                            
                                                @if(in_array("manage_workshift",$rd))
                                                    <option value="manage_workshift" selected>Manage Workshift</option>
                                                @else
                                                    <option value="manage_workshift">Manage Workshift</option>
                                                @endif
                                            
                                                @if(in_array("dashboard_attendance",$rd))
                                                    <option value="dashboard_attendance" selected>Dashboard Attendance</option>
                                                @else
                                                    <option value="dashboard_attendance">Dashboard Attendance</option>
                                                @endif
                                            
                                                @if(in_array("reports",$rd))
                                                    <option value="reports" selected>Reports</option>
                                                @else
                                                    <option value="reports">Reports</option>
                                                @endif
                                            
                                                @if(in_array("holidays",$rd))
                                                    <option value="holidays" selected>Holidays</option>
                                                @else
                                                    <option value="holidays">Holidays</option>
                                                @endif
                                            
                                                @if(in_array("manual_payslip",$rd))
                                                    <option value="manual_payslip" selected>Manual Payslip</option>
                                                @else
                                                    <option value="manual_payslip">Manual Payslip</option>
                                                @endif
                                            
                                                @if(in_array("credit",$rd))
                                                    <option value="credit" selected>Credit</option>
                                                @else
                                                    <option value="credit">Credit</option>
                                                @endif
                                            
                                                @if(in_array("deductions",$rd))
                                                    <option value="deductions" selected>Deductions</option>
                                                @else
                                                    <option value="deductions">Deductions</option>
                                                @endif
                                            
                                                @if(in_array("generate_salary_sheet",$rd))
                                                    <option value="generate_salary_sheet" selected>Generate Salary Sheet</option>
                                                @else
                                                    <option value="generate_salary_sheet">Generate Salary Sheet</option>
                                                @endif
                                            
                                                @if(in_array("apply_for_overtime",$rd))
                                                    <option value="apply_for_overtime" selected>Apply for Overtime</option>
                                                @else
                                                    <option value="apply_for_overtime">Apply for Overtime</option>
                                                @endif
                                            
                                                @if(in_array("overtime_requested_application",$rd))
                                                    <option value="overtime_requested_application" selected>Overtime Requested Application</option>
                                                @else
                                                    <option value="overtime_requested_application">Overtime Requested Application</option>
                                                @endif
                                                
                                                @if(in_array("apply_for_missing_attendance",$rd))
                                                    <option value="apply_for_missing_attendance" selected>Apply for Missing Attendance</option>
                                                @else
                                                    <option value="apply_for_missing_attendance">Apply for Missing Attendance</option>
                                                @endif
                                                
                                                @if(in_array("missing_attendance_requested_application",$rd))
                                                    <option value="missing_attendance_requested_application" selected>Missing Attendance Requested Application</option>
                                                @else
                                                    <option value="missing_attendance_requested_application">Missing Attendance Requested Application</option>
                                                @endif
                                        </select>
                                        <br>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
@endsection
