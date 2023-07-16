@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Workshifts</h1>
                        <a href="{{ route('atd/add-edit-workshifts')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add workshifts</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Workshifts</h6>
                        </div>
                        <div class="card-body">
                             @if (session()->has('success'))
                                <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Late Count Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Late Count Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($workshifts as $workshift)
                                        <tr>
                                            <td>{{ $workshift['id'] }}</td>
                                            <td>{{ $workshift['name'] }}</td>
                                            <td>{{ $workshift['start_time'] }}</td>
                                            <td>{{ $workshift['end_time'] }}</td>
                                            <td>{{ $workshift['late_count_time'] }}</td>
                                            <td><a title="delete" class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','/atd/delete-workshifts/{{ $workshift['id'] }}'); return false;"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
@endsection
