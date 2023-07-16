@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Manual Payslips</h1>
                        <a href="{{ route('payroll/add-manual_payslip')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add Payslip</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Manual Payslips</h6>
                        </div>
                        <div class="card-body">
                            @include('common.message')
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Basic Salary</th>
                                            <th>Total Deduction</th>
                                            <th>Total Gross</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Basic Salary</th>
                                            <th>Total Deduction</th>
                                            <th>Total Gross</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($manual_payslips as $manual_payslip)
                                        <tr>
                                            <td>{{ $manual_payslip['id_number'] }}</td>
                                            <td>{{ $manual_payslip['name'] }}</td>
                                            <td>{{ $manual_payslip['basic_salary'] }}</td>
                                            <td>{{ $manual_payslip['total_deduction'] }}</td>
                                            <td>{{ $manual_payslip['total_gross'] }}</td>
                                            <td>
                                                <a title="Generate Payslip" class="btn btn-success btn-circle btn-sm" href="/hr_yl/public/index.php/payroll/generate-manual_payslip/{{ $manual_payslip['id'] }}"><i class="fas fa-cog"></i></a>
                                                <a title="Send Payslip to {{ $manual_payslip['email_address'] }}" class="btn btn-dark btn-circle btn-sm" href="/hr_yl/public/index.php/payroll/send-manual_payslip/{{ $manual_payslip['id'] }}"><i class="fas fa-envelope"></i></a>
                                                <a title="Edit Payslip" class="btn btn-primary btn-circle btn-sm" href="/hr_yl/public/index.php/payroll/edit-manual_payslip/{{ $manual_payslip['id'] }}"><i class="fas fa-pen"></i></a>
                                                <a title="Delete Payslip" class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','/payroll/delete-manual_payslip/{{ $manual_payslip['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
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
