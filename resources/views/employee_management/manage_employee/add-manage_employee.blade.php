@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Employee</h1>
                        <a href="{{ route('em/manage_employee')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Add employee</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <h6 class="m-0 font-weight-bold text-gray-900">Employee Account</h5>
                             <hr>
                             <form action="{{ route('em/add-employee')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Role</label>
                                        <select type="text" style="padding:0px !important;" required class="form-control form-control-user" name="role_id">
                                            <option>--Select role--</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Username</label>
                                        <input type="text" class="form-control form-control-user" required password name="username"
                                            placeholder="Username">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Password</label>
                                        <input type="password" class="form-control form-control-user" required name="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Confirm password</label>
                                        <input type="password" class="form-control form-control-user" required name="confirm_password"
                                            placeholder="Confirm password">
                                    </div>
                                </div>
                                <h6 class="m-0 font-weight-bold text-gray-900">Employee Account</h5>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">First Name</label>
                                        <input type="text" class="form-control form-control-user" required name="first_name"
                                            placeholder="First Name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Middle Name</label>
                                        <input type="text" class="form-control form-control-user" required name="middle_name"
                                            placeholder="Middle Name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Last Name</label>
                                        <input type="text" class="form-control form-control-user" required name="last_name"
                                            placeholder="Last Name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Card No.</label>
                                        <input type="text" class="form-control form-control-user" required name="unique_id"
                                                placeholder="Card No.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Employee No.</label>
                                        <input type="text" class="form-control form-control-user" required name="employee_no"
                                                placeholder="Employee No.">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Supervisor</label>
                                        <select type="text" style="padding:0px !important;" required class="form-control form-control-user" placeholder="select department" name="supervisor_id">
                                            <option value="">--Select supervisor--</option>
                                            <option value="0">N/A</option>
                                            @foreach($users as $user)
                                                @if($user->id != $user_id)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Department</label>
                                        <select type="text" style="padding:0px !important;" required class="form-control form-control-user" placeholder="select department" name="department_id">
                                            <option value="">--Select department--</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Designation</label>
                                        <select type="text" style="padding:0px !important;" required class="form-control form-control-user" placeholder="select designation" name="designation_id">
                                            <option>--Select designation--</option>
                                            @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Branch</label>
                                        <select type="text" style="padding:0px !important;" required class="form-control form-control-user" placeholder="select branch" name="branch_id">
                                            <option>--Select branch--</option>
                                            @foreach($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Workshift</label>
                                        <select type="text" style="padding:0px !important;" required class="form-control form-control-user" placeholder="select work shift" name="work_shift_id">
                                            <option>--Select workshift--</option>
                                            @foreach($workshifts as $workshift)
                                            <option value="{{$workshift->id}}">{{$workshift->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Email</label>
                                        <input type="text" class="form-control form-control-user" required name="email"
                                            placeholder="email ">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Phone</label>
                                        <input type="text" class="form-control form-control-user" required name="phone"
                                            placeholder="Phone">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Gender</label>
                                        <select type="text" style="padding:0px !important;" required class="form-control form-control-user" name="gender">
                                        <option>--Select role--</option>    
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Religion</label>
                                        <input type="text" class="form-control form-control-user" required placeholder="Religion" name="religion">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date of Birth</label>
                                        <input type="date" class="form-control form-control-user" required name="date_of_birth"
                                            placeholder="First Name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date of Joining</label>
                                        <input type="date" class="form-control form-control-user" required name="date_of_joining"
                                            placeholder="Last Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Date of Leaving</label>
                                        <input type="date" class="form-control form-control-user" name="date_of_leaving"
                                                placeholder="Date of Leaving">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Marital Status</label>
                                        <input type="text" class="form-control form-control-user" required placeholder="Marital Status" name="marital_status">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0" style="display:none;">
                                        <label class="text-gray-900">Photo</label>
                                        <input type="file" style="padding: 5px !important;border-radius: 0;" class="form-control form-control-user" name="photo">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Address</label>
                                        <textarea type="text" class="form-control" name="address" required placeholder="Address"></textarea>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Emergency Contact</label>
                                        <textarea type="text" class="form-control" name="emergency_contacts" required placeholder="Emergency contact"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Salary</label>
                                        <input type="text" class="form-control form-control-user" required placeholder="Salary" name="salary_id">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Rest Day</label>
                                        <select type="text" style="padding:0px !important;border-radius:0px;" class="form-control form-control-user" required multiple placeholder="select status" name="rest_day[]">
                                            <option value="Mon">Monday</option>
                                            <option value="Tue">Tuesday</option>
                                            <option value="Wed">Wednesday</option>
                                            <option value="Thu">Thursday</option>
                                            <option value="Fri">Friday</option>
                                            <option value="Sat">Saturday</option>
                                            <option value="Sun">Sunday</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Status</label>
                                        <select type="text" style="padding:0px !important;" class="form-control form-control-user" required placeholder="select status" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <!--Deductions-->
                                <!-- <h6 class="m-0 font-weight-bold text-gray-900">Deductions</h5>
                                <hr>
                                <div class="form-group row">
                                    @foreach($deductions as $deduction)
                                        <div class="col-sm-3 mb-3 mb-sm-0">
                                            <label class="text-gray-900">{{$deduction->name}}</label>
                                            <input type="hidden" value="{{$deduction->id}}" required name="deduction_id_{{$deduction->id}}">
                                            <input type="number" step="0.01" class="form-control form-control-user" value="" name="deduction_{{\Str::slug(str_replace('-','',$deduction->name))}}"
                                                placeholder="{{$deduction->name}}">
                                        </div>
                                    @endforeach
                                </div> -->

                                <!--Credit-->
                                <!-- <h6 class="m-0 font-weight-bold text-gray-900">Credit</h5>
                                <hr>
                                <div class="form-group row">
                                    @foreach($credits as $credit)
                                        <div class="col-sm-3 mb-3 mb-sm-0">
                                            <label class="text-gray-900">{{$credit->name}}</label>
                                            <input type="hidden" value="{{$credit->id}}" required name="credit_id_{{$credit->id}}">
                                            <input type="number" step="0.01" class="form-control form-control-user" value="" name="credit_{{\Str::slug(str_replace('-','',$credit->name))}}"
                                                placeholder="{{$credit->name}}">
                                        </div>
                                    @endforeach
                                </div> -->


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
