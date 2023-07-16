@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Overtime Application</h1>
                        <a href="{{ route('payroll/overtime')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Apply for Overtime</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <h6 class="m-0 font-weight-bold text-gray-900">Employee Info</h5>
                             <hr>
                             <form action="{{ route('payroll/add-overtime')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Full Name</label>
                                        <input type="text" class="form-control form-control-user" required name="name" value="{{ $employee->first_name }} {{ $employee->last_name }}"
                                            placeholder="Full name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Employee Number</label>
                                        <input type="text" class="form-control form-control-user" required name="employee_no" value="{{ $employee->employee_no }}"
                                            placeholder="Employee number">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Department/Section</label>
                                        <input type="text" class="form-control form-control-user" required name="department"
                                            placeholder="Department">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date</label>
                                        <input type="date" class="form-control form-control-user" min="{{date("Y-m-d")}}" required name="date"
                                            placeholder="Date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Actual Log</label>
                                        <input type="text" class="form-control form-control-user" required name="actual_log"
                                            placeholder="e.g. 05:00 PM - 06:00 PM">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">No of hours</label>
                                        <input type="text" class="form-control form-control-user" required name="no_of_hours"
                                            placeholder="No of hours">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Reason for overtime</label>
                                        <input type="text" class="form-control form-control-user" required name="reason_of_ot"
                                            placeholder="Reason for overtime">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Remarks</label>
                                        <input type="text" class="form-control form-control-user" name="remarks"
                                            placeholder="Remarks">
                                    </div>
                                </div>

                                <hr>
                                
                                <div class="form-group row">
                                     <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Department Head</label>
                                        <input type="text" class="form-control form-control-user" name="department_head"
                                                placeholder="Department Head">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Officer in-charge</label>
                                        <input type="text" class="form-control form-control-user" name="immediate_supervisor"
                                                placeholder="Immediate Superior / Date">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">HRD:</label>
                                        <input type="text" class="form-control form-control-user" name="hrd"
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
