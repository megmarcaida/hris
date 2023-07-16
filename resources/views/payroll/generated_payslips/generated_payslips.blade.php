@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Generated Payslips</h1>
                        <a href="{{ route('payroll/add-generated_payslips')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add generated payslips</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of generated payslips
                            <a href="{{ route('payroll/report')}}" style="float:right" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-list fa-sm text-white-50"></i> Generate Payroll Report</a></h6>
                        </div>
                        <div class="card-body">
                            @include('common.message')
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name | Cut-off</th>
                                            <th>Working Hours</th>
                                            <th>Net Pay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name | Cut-off</th>
                                            <th>Working Hours</th>
                                            <th>Net Pay</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($generated_payslips as $generated_payslip)
                                        <tr>
                                            <td>{{ $generated_payslip['id'] }}</td>
                                            <td>{{ $generated_payslip['month_of_salary'] }}</td>
                                            <td>{{ $generated_payslip['working_hour'] }}</td>
                                            <td>{{ 'P' . number_format($generated_payslip['net_salary'],2) }}</td>
                                            <td>
                                            <a class="btn btn-success btn-circle btn-sm" title="Generate PDF" href="generate-payslip/{{ $generated_payslip['id'] }}"><i class="fas fa-cog"></i></a>
                                                <a class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','/payroll/delete-generated_payslip/{{ $generated_payslip['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
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
