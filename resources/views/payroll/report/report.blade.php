@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Report - Payroll</h1>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of payslips</h6>
                        </div>
                        <div class="card-body">
                            
                        <form method="post" action="{{ route('payroll/report')}}">
                             @csrf
                            <input id="from_date" type="date" class="form-control form-control-user" required name="from">
                            <input id="to_date" type="date" class="form-control form-control-user" required name="to">
                            <input type="submit" class="btn btn-primary btn-user btn-block" name="generate_payroll" value="Generate Payroll">
                            <input type="submit" class="btn btn-primary btn-user btn-block" name="filter" value="Filter">
                        </form>
                            @include('common.message')
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cut-off Date</th>
                                            <th>Working Hours</th>
                                            <th>Net Pay</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Cut-off Date</th>
                                            <th>Working Hours</th>
                                            <th>Net Pay</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($generated_payslips as $generated_payslip)
                                        <tr>
                                            <td>{{ $generated_payslip['id'] }}</td>
                                            <td>{{ $generated_payslip['month_of_salary'] }}</td>
                                            <td>{{ $generated_payslip['working_hour'] }}</td>
                                            <td>{{ 'P' . number_format($generated_payslip['net_salary'],2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                        {{ $generated_payslips->links() }}
                            </div>
                        </div>
                    </div>

                </div>
                <script>
                    $("#from_date").on('change',function(){
                      $("#from").val($('#from_date').val())  
                    })
                    $("#to_date").on('change',function(){
                      $("#to").val($('#to_date').val())  
                    })
                </script>
@endsection
