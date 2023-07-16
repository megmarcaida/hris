@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Employee Deduction</h1>
                        <a href="/hr_yl/public/index.php/payroll/employee-deductions/{{ $employee_id }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit employee deduction</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <form action="/hr_yl/public/index.php/payroll/edit-employee-deductions/{{ $employee_id }}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 offset-3 mb-3 mb-sm-0">
                                        <input type="hidden" required class="form-control form-control-user" name="employee_id" value="{{ $employee_id }}">
                                        <br>
                                        <select type="select" style="padding-top:0px !important;padding-bottom:0px !important" required class="form-control form-control-user" name="deduction_id"> 
                                            <option value="">Select Deduction</option>
                                            @foreach($deductions as $deduction)
                                                @if($deduction->id == $employee_deduction->deduction_id)
                                                <option value="{{ $deduction->id }}" selected>{{ $deduction->name }}</option>
                                                @else
                                                <option value="{{ $deduction->id }}">{{ $deduction->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <br>
                                        <input type="number" required class="form-control form-control-user" name="amount" placeholder="Amount" value="{{ $employee_deduction->amount }}">
                                        <br>
                                        <input type="number" required class="form-control form-control-user" name="terms" placeholder="Terms of Payment" value="{{ $employee_deduction->terms }}">
                                        <br>
                                        <input type="number" required class="form-control form-control-user" name="date" placeholder="Date of payment each month" value="{{ $employee_deduction->date }}">
                                        <br>
                                        Due Date: 
                                        <input type="date" required class="form-control form-control-user" name="due_date" placeholder="Due Date" value="{{ $employee_deduction->due_date }}">
                                        <br>
                                        <br>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
@endsection
