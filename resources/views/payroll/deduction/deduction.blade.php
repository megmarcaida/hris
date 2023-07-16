@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Deduction</h1>
                        <a href="{{ route('payroll/add-deduction')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add deduction</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Deduction</h6>
                        </div>
                        <div class="card-body">
                            @include('common.message')
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Option</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Tax</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($deductions as $deduction)
                                        <tr>
                                            <td>{{ $deduction['id'] }}</td>
                                            <td>{{ $deduction['name'] }}</td>
                                            <td>{{ $deduction['type'] }}</td>
                                            <td>{{ $deduction['tax'] }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-circle btn-sm" href="edit-deduction/{{ $deduction['id'] }}"><i class="fas fa-pen"></i></a>
                                                <a class="btn btn-success btn-circle btn-sm" href="range-table-deduction/{{ $deduction['id'] }}"><i class="fas fa-table "></i></a>
                                                <a class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','/payroll/delete-deduction/{{ $deduction['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
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
