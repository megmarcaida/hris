@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Designation</h1>
                        <a href="{{ route('em/add-designation')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Add designation</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Designation</h6>
                        </div>
                        <div class="card-body">
                            @include('common.message')
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($designations as $designation)
                                        <tr>
                                            <td>{{ $designation['id'] }}</td>
                                            <td>{{ $designation['name'] }}</td>
                                            <td>
                                            <a class="btn btn-primary btn-circle btn-sm" href="edit-designation/{{ $designation['id'] }}"><i class="fas fa-pen"></i></a>
                                            <a class="btn btn-danger btn-circle btn-sm" href="#" onclick="confirmPopup('Are you sure you want to delete?','/em/delete-designation/{{ $designation['id'] }}'); return false;"><i class="fas fa-trash"></i></a>
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
