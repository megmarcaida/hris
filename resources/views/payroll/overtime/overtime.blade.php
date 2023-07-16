@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Overtime Applications</h1>
                        <a href="{{ route('payroll/add-overtime')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add Overtime</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Requested Application</h6>
                        </div>
                        <div class="card-body">
                            @include('common.message')
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Employee No</th>
                                            <th>Date of overtime</th>
                                            <th>Hours of overtime</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Employee No</th>
                                            <th>Date of overtime</th>
                                            <th>Hours of overtime</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($overtimes as $overtime)
                                        <tr>
                                            <td>{{ $overtime['name'] }}</td>
                                            <td>{{ $overtime['employee_no'] }}</td>
                                            <td>{{ $overtime['date'] }}</td>
                                            <td>{{ $overtime['no_of_hours'] }}</td>
                                            <td>{{ $overtime['status'] }}</td>
                                            <td>
                                                <a title="Edit Application" class="btn btn-primary btn-circle btn-sm" href="/hr_yl/public/index.php/payroll/edit-overtime/{{ $overtime['id'] }}"><i class="fas fa-pen"></i></a>
                                                <a title="Delete Application" class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','delete-overtime/{{ $overtime['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
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
