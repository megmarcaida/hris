@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Total Employee -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Employee</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i style="color:green" class="fas fa-arrow-up"></i> 5</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Departments -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="{{ route('leave_management/leave') }}" style="text-decoration:none;">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    For Approval</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><i style="color:green" class="fas fa-arrow-up"></i> 0</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Presents -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Present</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i style="color:green" class="fas fa-arrow-up"></i> 0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Absent -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Absent</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i style="color:green" class="fas fa-arrow-up"></i> 0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    

                    <div class="row">

                        <!-- Total Employee -->
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card o-hidden border-0 shadow-lg ">
                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h4 clsas="h4 text-gray-900 mb-4">Welcome Back!</h4>
                                                    
                                                    @if ($success)
                                                        <div class="alert alert-success">
                                                                {{ $success }} <br> {{ $time }}
                                                        </div>
                                                    @endif
                                                    @if($error)
                                                        <div class="alert alert-danger">
                                                                {{ $error }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <form method="POST" action="{{ route('home') }}">
                                                    @csrf
                                                    
                                                    <div class="form-group">
                                                        <input placeholder="Card No" type="text" class="form-control" name="unique_id" required autofocus>
                                                        <br>
                                                        <textarea placeholder="Reason" type="text" class="form-control" name="Memoinfo" required autofocus></textarea>
                                                        
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" name="time_in" class="btn btn-primary btn-block">
                                                        {{ __('Time In / Out') }}
                                                    </button>
                                                </form>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Today Attendance -->
                        <div class="col-xl-9 col-md-9 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Today Attendance</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Photo</th>
                                                    <th>Name</th>
                                                    <th>Time-in</th>
                                                    <th>Time-out</th>
                                                    <th>Late</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Card#</th>
                                                    <th>Photo</th>
                                                    <th>Name</th>
                                                    <th>Time-in</th>
                                                    <th>Time-out</th>
                                                    <th>Late</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($employee_attendances as $employee_in_out)
                                                <tr>
                                                    <td>{{ $employee_in_out->unique_id }}</td>
                                                    <td>N/A</td>
                                                    <td>{{ $employee_in_out->name }}</td>
                                                    <td>{{ $employee_in_out->in_time }}</td>
                                                    <td>{{ $employee_in_out->out_time == "" ? "-" : $employee_in_out->out_time }}</td>
                                                    <td>
                                                        {{ date('H:i:s', strtotime($employee_in_out->in_time)) > date('H:i:s', $late_count_time) ? "Late" : "" }} <br>
                                                        {{ date('H:i:s', strtotime($employee_in_out->in_time))  }} <br>
                                                        {{ date('H:i:s', $late_count_time) }} <br>
                                                        
                                                        
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
@endsection
