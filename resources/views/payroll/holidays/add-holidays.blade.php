@extends('layouts.master')

@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Holidays</h1>
                        <a href="{{ route('payroll/holidays')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>


                    <!-- Role -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add holidays</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">
                             <form action="{{ route('payroll/add-holidays')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 offset-3 mb-3 mb-sm-0">
                                        <input type="text" required class="form-control form-control-user" name="name"
                                            placeholder="Holiday name">
                                        <br>
                                        <input type="text" required class="form-control form-control-user" name="value"
                                            placeholder="Percentage">
                                        <br>
                                        <input type="date" required class="form-control form-control-user" id="date" name="date"
                                            placeholder="Date">
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
                <script>
                    var year = new Date().getFullYear();
                    document.getElementById('date').setAttribute("min", year + "-01-01");
                    document.getElementById('date').setAttribute("max", year + "-12-31");
                </script>
@endsection
