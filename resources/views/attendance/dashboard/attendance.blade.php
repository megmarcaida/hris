@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Attendance Dashboard</h1>
                        <form action="{{ route('atd/dashboard/import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <div class="custom-file text-left" style="display:inline-grid">
                                    <input type="file" required name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <button class="btn btn-primary">Upload Attendance</button>
                            
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>

                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Time In and Out</h6>
                        </div>
                        <div class="card-body">
                            @include('common.message')
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Time-in</th>
                                                    <th>Time-out</th>
                                                    <th>Late</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Card#</th>
                                                    <th>Name</th>
                                                    <th>Time-in</th>
                                                    <th>Time-out</th>
                                                    <th>Late</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($employee_attendances as $employee_in_out)
                                                <tr>
                                                    <td>{{ $employee_in_out->unique_id }}</td>
                                                    <td>{{ $employee_in_out->name }}</td>
                                                    <td>{{ $employee_in_out->in_time }}</td>
                                                    <td>{{ $employee_in_out->out_time == "" ? "-" : $employee_in_out->out_time }}</td>
                                                    <td></td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                    </div>

                </div>
@endsection
