@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Workshifts</h1>
                        <a href="{{ route('atd/workshifts')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add branch</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <form action="{{ route('atd/add-edit-workshifts')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label>Workshift Name</label>
                                        <input type="text" class="form-control form-control-user" name="name"
                                            placeholder="Workshift name">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control form-control-user" name="start_time">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label>End Time</label>
                                        <input type="time" class="form-control form-control-user" name="end_time">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label>Late Count Time</label>
                                        <input type="time" class="form-control form-control-user" name="late_count_time">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 offset-3 mb-3 mb-sm-0">
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
