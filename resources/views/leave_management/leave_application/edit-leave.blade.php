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
                            <h5 class="m-0 font-weight-bold text-primary">Application for Leave - {{ $leave['name'] }}</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <h6 class="m-0 font-weight-bold text-gray-900">Employee Info</h5>
                             <hr>
                             <form action="{{ route('leave_management/edit-leave')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Full Name</label>
                                        <input type="hidden" class="form-control form-control-user" name="id" value="{{ $leave['id'] }}">
                                        <input type="text" class="form-control form-control-user" required name="name" value="{{ $leave['name'] }}"
                                            placeholder="Full name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Employee Number</label>
                                        <input type="text" class="form-control form-control-user" required name="employee_no" value="{{ $leave['employee_no'] }}"
                                            placeholder="Employee number">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Position</label>
                                        <input type="text" class="form-control form-control-user" required name="position" value="{{ $leave['position'] }}"
                                            placeholder="Position">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Department/Section</label>
                                        <input type="text" class="form-control form-control-user" required name="department" value="{{ $leave['department'] }}"
                                            placeholder="Department">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">No of day/s applied</label>
                                        <input type="text" class="form-control form-control-user" name="no_of_days" value="{{ $leave['no_of_days'] }}"
                                            placeholder="No of day/s applied">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date from</label>
                                        <input type="date" class="form-control form-control-user" name="from" min="{{date("Y-m-d")}}" value="{{ $leave['from'] }}"
                                            placeholder="Date from">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date to</label>
                                        <input type="date" class="form-control form-control-user" name="to" min="{{date("Y-m-d")}}" value="{{ $leave['to'] }}"
                                            placeholder="Date to">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Reason for leave</label>
                                        <input type="text" class="form-control form-control-user" name="reason" value="{{ $leave['reason'] }}"
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
                                            <option value="Vacation" {{$leave->leave_type == "Vacation" ? 'selected' : ''}}>Vacation</option>
                                            <option value="Sick" {{$leave->leave_type == "Sick" ? 'selected' : ''}}>Sick</option>
                                            <option value="Leave without pay" {{$leave->leave_type == "Leave without pay" ? 'selected' : ''}}>Leave without pay</option>
                                            <option value="Emergency" {{$leave->leave_type == "Emergency" ? 'selected' : ''}}>Emergency</option>
                                            <option value="Maternity / Paternity" {{$leave->leave_type == "Maternity / Paternity" ? 'selected' : ''}}>Maternity / Paternity</option>
                                            <option value="Bereavement" {{$leave->leave_type == "Bereavement" ? 'selected' : ''}}>Bereavement</option>
                                            <option value="Official Business" {{$leave->leave_type == "Official Business" ? 'selected' : ''}}>Official Business</option>
                                            <option value="Offset Date" {{$leave->leave_type == "Offset Date" ? 'selected' : ''}}>Offset Date/s</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">For Offset Date/s only</label>
                                        <input type="date" class="form-control form-control-user" name="offset_date" value="{{ $leave['offset_date'] }}"
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
                                            <option value="Sick Leave Cleared" {{$leave->is_cleared == "Sick Leave Cleared" ? 'selected' : ''}}>Sick Leave Cleared</option>
                                            <option value="Sick Leave Not Cleared" {{$leave->is_cleared == "Sick Leave Not Cleared" ? 'selected' : ''}}>Sick Leave Not Cleared</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Cleared by</label>
                                        <input type="text" class="form-control form-control-user" name="cleared_by" value="{{ $leave['cleared_by'] }}"
                                                placeholder="Cleared by">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Medical certificate</label>
                                        <input type="text" class="form-control form-control-user" name="medical_certificate" value="{{ $leave['medical_certificate  '] }}"
                                                placeholder="Medical certificate">
                                    </div>
                                </div>

                                <h6 class="m-0 font-weight-bold text-gray-900">Undertime</h5>
                                <hr>
                                <div class="form-group row">
                                     <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">No of hours requested: (minimum of four (4) hours worked)</label>
                                        <input type="text" class="form-control form-control-user" name="undertime_no_of_hours" value="{{ $leave['undertime_no_of_hours'] }}"
                                                placeholder="No of hours requested">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date</label>
                                        <input type="date" class="form-control form-control-user" name="undertime_date" value="{{ $leave['undertime_date'] }}"
                                            placeholder="Date">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Approved by</label>
                                        <input type="text" class="form-control form-control-user" name="undertime_approved_by" value="{{ $leave['undertime_approved_by'] }}"
                                                placeholder="Approved by">
                                    </div>
                                </div>

                                <hr>
                                
                                <div class="form-group row">
                                     <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Requested by</label>
                                        <input type="text" class="form-control form-control-user" required name="requested_by" value="{{ $leave['requested_by'] }}"
                                                placeholder="Employee's Signature / Date">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Approved by</label>
                                        <input type="text" class="form-control form-control-user" name="approved_by" value="{{ $leave['approved_by'] }}"
                                                placeholder="Immediate Superior / Date">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">HRD Transmittal: - Received /Reviewed by:</label>
                                        <input type="text" class="form-control form-control-user" name="reviewed_by" value="{{ $leave['reviewed_by'] }}"
                                                placeholder="HR / Date">
                                    </div>
                                    @if(Auth::user()->role_id != 1)
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Status</label>
                                        <select type="select" style="padding-top:0px !important;padding-bottom:0px !important" class="form-control form-control-user" name="status"> 
                                            <option value="">Is approved?</option>
                                            <option value="Approved" {{$leave->is_cleared == "Approved" ? 'selected' : ''}}>Approved</option>
                                            <option value="Not Approved" {{$leave->status == "Not Approved" ? 'selected' : ''}}>Not Approved</option>
                                        </select>
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 offset-9 mb-3 mb-sm-0">
                                        <br>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Update
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
