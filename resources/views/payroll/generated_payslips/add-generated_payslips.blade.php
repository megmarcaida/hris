@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Generate Payslips</h1>
                        <a href="{{ route('payroll/generated_payslips')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add payslips</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                            
                             <form action="{{ route('payroll/add-generated_payslips')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 offset-3 mb-3 mb-sm-0">
                                        <select class="form-control" name="employee_id">
                                            <option value="">-All-</option>
                                            @foreach($employees as $emp_k => $emp_v)
                                            <option value="{{$emp_v->id}}">{{ $emp_v->first_name }} {{ $emp_v->last_name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <input type="date" required class="form-control form-control-user" name="from" value="2023-01-01">
                                        <br>
                                        <input type="date" required class="form-control form-control-user" name="to" value="2023-01-15">
                                        <br>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
@endsection
