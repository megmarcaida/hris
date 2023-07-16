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
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Departments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i style="color:green" class="fas fa-arrow-up"></i> 0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

                    <!-- Today Attendance -->
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
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Time-in</th>
                                            <th>Time-out</th>
                                            <th>Late</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>000001</td>
                                            <td>N/A</td>
                                            <td>Test 1</td>
                                            <td>11:34 AM</td>
                                            <td>-</td>
                                            <td>34m</td>
                                        </tr>
                                        <tr>
                                            <td>000002</td>
                                            <td>N/A</td>
                                            <td>Test 2</td>
                                            <td>09:20 AM</td>
                                            <td>-</td>
                                            <td>20m</td>
                                        </tr>
                                        <tr>
                                            <td>000003</td>
                                            <td>N/A</td>
                                            <td>Test 3</td>
                                            <td>08:02 AM</td>
                                            <td>-</td>
                                            <td>2m</td>
                                        </tr>
                                        <tr>
                                            <td>000006</td>
                                            <td>N/A</td>
                                            <td>Test 4</td>
                                            <td>08:01 AM</td>
                                            <td>-</td>
                                            <td>1m</td>
                                        </tr>
                                        <tr>
                                            <td>000015</td>
                                            <td>N/A</td>
                                            <td>Test 5</td>
                                            <td>09:05 AM</td>
                                            <td>-</td>
                                            <td>5m</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
@endsection
