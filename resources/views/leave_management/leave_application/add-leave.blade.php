@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Leave Application</h1>
                        <a href="{{ route('leave_management/leave')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Apply for Leave</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <h6 class="m-0 font-weight-bold text-gray-900">Employee Info</h5>
                             <hr>
                             <form action="{{ route('leave_management/add-leave')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Full Name</label>
                                        <input type="text" class="form-control form-control-user" required password name="name" value="{{ $employee->first_name }} {{ $employee->last_name }}"
                                            placeholder="Full name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Employee Number</label>
                                        <input type="text" class="form-control form-control-user" required password name="employee_no" value="{{ $employee->employee_no }}"
                                            placeholder="Employee number">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Position</label>
                                        <input type="text" class="form-control form-control-user" required password name="position"
                                            placeholder="Position">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Department/Section</label>
                                        <input type="text" class="form-control form-control-user" required password name="department"
                                            placeholder="Department">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">No of day/s applied</label>
                                        <input type="text" class="form-control form-control-user" password name="no_of_days"
                                            placeholder="No of day/s applied">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date from</label>
                                        <input type="date" class="form-control form-control-user" min="{{date("Y-m-d")}}"  password name="from"
                                            placeholder="Date from">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date to</label>
                                        <input type="date" class="form-control form-control-user" min="{{date("Y-m-d")}}"  password name="to"
                                            placeholder="Date to">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Reason for leave</label>
                                        <input type="text" class="form-control form-control-user" password name="reason"
                                            placeholder="Reason for leave">
                                    </div>
                                </div>

                                <h6 class="m-0 font-weight-bold text-gray-900">Leave applied for</h5>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Late</label>
                                        <select type="select" style="padding-top:0px !important;padding-bottom:0px !important" class="form-control form-control-user" name="leave_type"> 
                                            <option value="">Select Leave Type</option>
                                            <option value="Vacation">Vacation</option>
                                            <option value="Sick">Sick</option>
                                            <option value="Leave without pay">Leave without pay</option>
                                            <option value="Emergency">Emergency</option>
                                            <option value="Maternity / Paternity">Maternity / Paternity</option>
                                            <option value="Bereavement">Bereavement</option>
                                            <option value="Official Business">Official Business</option>
                                            <option value="Offset Date">Offset Date/s</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">For Offset Date/s only</label>
                                        <input type="date" class="form-control form-control-user" password name="offset_date"
                                            placeholder="For Offset Date/s">
                                    </div>
                                </div>
                                
                                <h6 class="m-0 font-weight-bold text-gray-900">For Sick Leave Only</h5>
                                <hr>
                                <div class="form-group row">
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Late</label>
                                        <select type="select" style="padding-top:0px !important;padding-bottom:0px !important" class="form-control form-control-user" name="is_cleared"> 
                                            <option value="">Is sick leave cleared?</option>
                                            <option value="Sick Leave Cleared">Sick Leave Cleared</option>
                                            <option value="Sick Leave Not Cleared">Sick Leave Not Cleared</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Cleared by</label>
                                        <input type="text" class="form-control form-control-user" name="cleared_by"
                                                placeholder="Cleared by">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Medical certificate</label>
                                        <input type="text" class="form-control form-control-user" name="medical_certificate"
                                                placeholder="Medical certificate">
                                    </div>
                                </div>

                                <h6 class="m-0 font-weight-bold text-gray-900">Undertime</h5>
                                <hr>
                                <div class="form-group row">
                                     <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">No of hours requested: (minimum of four (4) hours worked)</label>
                                        <input type="text" class="form-control form-control-user" name="undertime_no_of_hours"
                                                placeholder="No of hours requested">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date</label>
                                        <input type="date" class="form-control form-control-user" name="undertime_date"
                                            placeholder="Date">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Approved by</label>
                                        <input type="text" class="form-control form-control-user" name="undertime_approved_by"
                                                placeholder="Approved by">
                                    </div>
                                </div>

                                <hr>
                                
                                <div class="form-group row">
                                     <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Requested by</label>
                                        <input type="text" class="form-control form-control-user" required name="requested_by"
                                                placeholder="Employee's Signature / Date">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Approved by</label>
                                        <input type="text" class="form-control form-control-user" name="approved_by"
                                                placeholder="Immediate Superior / Date">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">HRD Transmittal: - Received /Reviewed by:</label>
                                        <input type="text" class="form-control form-control-user" name="reviewed_by"
                                                placeholder="HR / Date">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 offset-9 mb-3 mb-sm-0">
                                        <br>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Save
                                        </button>
                                    </div>
                                </div>
                             <hr>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- <script>
                    setTimeout(function(){
                        window.location.reload(1);
                    }, 5000);
                </script> -->
@endsection
