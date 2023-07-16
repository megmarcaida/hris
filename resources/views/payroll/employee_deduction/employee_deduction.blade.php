@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $employee->first_name }}  {{ $employee->last_name }} Deductions</h1>
                        <a href="/hr_yl/public/index.php/payroll/add-employee-deductions/{{ $employee->id }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add Deduction</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="float-right">
                            <a href="/hr_yl/public/index.php/em/manage_employee" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                            </div>
                            <h6 class="m-0 font-weight-bold text-primary">List of Employee Deduction</h6>
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
                                            <th>Amount</th>
                                            <th>Due Date</th>
                                            <th>Day to Pay</th>
                                            <th>Terms</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Due Date</th>
                                            <th>Day to Pay</th>
                                            <th>Terms</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($employee_deduction as $employee)
                                        <tr>
                                            <td>{{ $employee['id'] }}</td>
                                            <td>{{ $employee['deduction']['name'] }}</td>
                                            <td>{{ $employee['amount'] }}</td>
                                            <td>{{ $employee['due_date'] }}</td>
                                            <?php 
                                            $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                                            $number = $employee['date'];
                                            if (($number %100) >= 11 && ($number%100) <= 13)
                                               $abbreviation = $number. 'th';
                                            else
                                               $abbreviation = $number. $ends[$number % 10];
                                            ?>
                                            <td>Every {{ $abbreviation }} of the month</td>
                                            <td>{{ $employee['terms'] }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-circle btn-sm" href="/payroll/edit-employee-deductions/{{ $employee['id'] }}"><i class="fas fa-pen"></i></a>
                                                <a class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','/payroll/delete-employee-deductions/{{ $employee['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
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
