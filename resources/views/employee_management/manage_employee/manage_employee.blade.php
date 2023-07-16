@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Employee</h1>
                        <a href="{{ route('em/add-employee')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add Employee</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Employee</h6>
                        </div>
                        <div class="card-body">
                             @if (session()->has('success'))
                                <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Phone</th>
                                            <th>Card No.</th>
                                            <th>Date of Joining</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Phone</th>
                                            <th>Card No.</th>
                                            <th>Date of Joining</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($employees as $employee)
                                        <tr>
                                            <td>{{ $employee['id'] }}</td>
                                            <td>{{ $employee['user']['name'] }}</td>
                                            <td>{{ $employee['department']['name'] }}</td>
                                            <td>{{ $employee['phone'] }}</td>
                                            <td>{{ $employee['unique_id'] }}</td>
                                            <td>{{ $employee['date_of_joining'] }}</td>
                                            <td>{{ $employee['status'] == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a class="btn btn-danger btn-circle btn-sm" href="/hr_yl/public/index.php/payroll/employee-deductions/{{ $employee['id'] }}" title="Manage Deductions"><i class="fas fa-money-bill"></i></a>
                                                <a class="btn btn-success btn-circle btn-sm" href="/hr_yl/public/index.php/payroll/employee-credits/{{ $employee['id'] }}" title="Manage Credits"><i class="fas fa-dollar-sign"></i></a>
                                                <a class="btn btn-primary btn-circle btn-sm" href="/hr_yl/public/index.php/em/edit-employee/{{ $employee['id'] }}"><i class="fas fa-pen"></i></a>
                                                <a class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','/em/delete-employee/{{ $employee['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
@endsection
