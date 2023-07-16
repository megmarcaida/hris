@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Leave Applications</h1>
                        <a href="{{ route('leave_management/add-leave')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add Leave</a>
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
                                            <th>Leave Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Employee No</th>
                                            <th>Leave Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($leaves as $leave)
                                        <tr>
                                            <td>{{ $leave['name'] }}</td>
                                            <td>{{ $leave['employee_no'] }}</td>
                                            <td>{{ $leave['leave_type'] }}</td>
                                            <td>{{ $leave['status'] }}</td>
                                            <td>
                                                <?php 
                                                $now = time(); // or your date as well
                                                $your_date = strtotime($leave['from']);
                                                $datediff = $your_date - $now;
                                                $diff = round($datediff / (60 * 60 * 24));
                                                ?>
                                                @if($diff > 3 || Auth::user()->role_id == 2) 
                                                <a title="Edit Application" class="btn btn-primary btn-circle btn-sm" href="/hr_yl/public/index.php/leave_management/edit-leave/{{ $leave['id'] }}"><i class="fas fa-pen"></i></a>
                                                @endif
                                                <a title="Cancel/Delete Application" class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to cancel/delete this application?','delete-leave/{{ $leave['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
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
