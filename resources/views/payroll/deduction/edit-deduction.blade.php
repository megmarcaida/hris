@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Deduction</h1>
                        <a href="{{ route('payroll/deduction')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit deduction</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <form action="{{ route('payroll/edit-deduction')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 offset-3 mb-3 mb-sm-0">
                                        <input type="hidden" class="form-control form-control-user" name="id" value="{{ $deduction->id }}">
                                        <input type="text" class="form-control form-control-user" name="name" value="{{ $deduction->name }}"
                                            placeholder="Deduction name">
                                        <br>
                                        <select type="select" style="padding-top:0px !important;padding-bottom:0px !important" required class="form-control form-control-user" name="type"> 
                                            <option value="">Select Type</option>
                                            <option value="Fixed" {{$deduction->type == "Fixed" ? 'selected' : ''}}>Fixed</option>
                                            <option value="Percentage" {{$deduction->type == "Percentage" ? 'selected' : ''}}>Percentage</option>
                                        </select>
                                        <br>
                                        <select type="select" style="padding-top:0px !important;padding-bottom:0px !important" required class="form-control form-control-user" name="tax"> 
                                            <option value="">Select Option</option>
                                            <option value="TX" {{$deduction->tax == "TX" ? 'selected' : ''}}>TX</option>
                                            <option value="NTX" {{$deduction->tax == "NTX" ? 'selected' : ''}}>NTX</option>
                                            <option value="Loan" {{$deduction->tax == "Loan" ? 'selected' : ''}}>Loan</option>
                                            <option value="Other" {{$deduction->tax == "Other" ? 'selected' : ''}}>Other</option>
                                        </select>
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
