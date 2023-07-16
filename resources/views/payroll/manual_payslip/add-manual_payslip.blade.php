@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Payslip</h1>
                        <a href="{{ route('payroll/manual_payslip')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Add manual payslip</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <h6 class="m-0 font-weight-bold text-gray-900">Employee Info</h5>
                             <hr>
                             <form action="{{ route('payroll/add-manual_payslip')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Full Name</label>
                                        <input type="text" class="form-control form-control-user" required password name="name"
                                            placeholder="Full name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">ID Number</label>
                                        <input type="text" class="form-control form-control-user" required password name="id_number"
                                            placeholder="ID number">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Company Name</label>
                                        <input type="text" class="form-control form-control-user" required password name="company_name"
                                            placeholder="Company name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Basic Salary</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required password name="basic_salary"
                                            placeholder="Basic salary">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Email Address</label>
                                        <input type="email" class="form-control form-control-user" required password name="email_address"
                                            placeholder="Email Address">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Overtime</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required password name="overtime"
                                            placeholder="Overtime">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Cut-off Date</label>
                                        <input type="date" class="form-control form-control-user" required name="cut_off_date">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Payout Date</label>
                                        <input type="date" class="form-control form-control-user" required name="pay_out_date">
                                    </div>
                                </div>

                                <h6 class="m-0 font-weight-bold text-gray-900">Deductions</h5>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Late</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="late"
                                            placeholder="Late">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Absent</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="absent"
                                            placeholder="Absent">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Tax</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="tax"
                                            placeholder="Tax">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">SSS</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="sss"
                                            placeholder="SSS">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">HDMF</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="hdmf"
                                                placeholder="HDMF">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">PHIC</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="phic"
                                                placeholder="PHIC">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Loan</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="loan"
                                                placeholder="Loan">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Other Deduction</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="other_deduction"
                                                placeholder="Other Deduction">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Total Deduction</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="total_deduction"
                                                placeholder="Total Deduction">
                                    </div>
                                </div>

                                <h6 class="m-0 font-weight-bold text-gray-900">Total Gross, Allowances, Other credit and Net Pay etc.</h5>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Total Gross</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="total_gross"
                                                placeholder="Total Gross">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Allowances</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="allowances"
                                                placeholder="Allowances">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Other Credit</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="other_credit"
                                                placeholder="Other Credit">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">Net Pay</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="net_pay"
                                                placeholder="Other Credit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">HDMF Loan Balance</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="hdmf_loan_balance"
                                                placeholder="HDMF Loan Balance">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label class="text-gray-900">SSS Loan Balance</label>
                                        <input type="number" step=".01" class="form-control form-control-user" required name="sss_loan_balance"
                                                placeholder="SSS Loan Balance">
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
