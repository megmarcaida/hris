@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Missing Attendance Applications</h1>
                        <a href="{{ route('payroll/add-missing_attendance')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add Missing Attendance Application</a>
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
                                            <th>Card No</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Card No</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($missing_attendances as $missing_attendance)
                                        <tr>
                                            <td>{{ $missing_attendance['name'] }}</td>
                                            <td>{{ $missing_attendance['employee_no'] }}</td>
                                            <td>{{ $missing_attendance['date'] }}</td>
                                            <td>{{ $missing_attendance['status'] }}</td>
                                            <td>
                                                <a title="Edit Application" class="btn btn-primary btn-circle btn-sm" href="/hr_yl/public/index.php/payroll/edit-missing_attendance/{{ $missing_attendance['id'] }}"><i class="fas fa-pen"></i></a>
                                                <a title="Delete Application" class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','delete-missing_attendance/{{ $missing_attendance['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
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
