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
                            <h6 class="m-0 font-weight-bold text-primary">{{ $deduction->name }} Table</h6>
                        </div>
                        @if ($success)
                            <div class="alert alert-success">
                                    {{ $success }}
                            </div>
                        @endif
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Bracket</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Percentage</th>
                                                    <th>Fixed Tax</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rangetable as $r)
                                                <tr>
                                                    <td>{{ $r->name }}</td>
                                                    <td>{{ $r->bracket }}</td>
                                                    <td>{{ $r->from }}</td>
                                                    <td>{{ $r->to }}</td>
                                                    <td>{{ $r->percentage }}</td>
                                                    <td>{{ $r->fixed_tax }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                            </div>

                             <form action="{{ route('payroll/range-table-deduction')}}" method="post" class="user">
                             @csrf
                                <div class="form-group row">
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                    <input type="hidden" required class="form-control form-control-user" name="range_table_id" value=""
                                            placeholder="id">
                                        <input type="hidden" required class="form-control form-control-user" name="id" value="{{ $deduction->id }}"
                                            placeholder="id">
                                        <input type="text" required class="form-control form-control-user" name="name"
                                            placeholder="Name">
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <input type="text" required class="form-control form-control-user" name="bracket"
                                            placeholder="Bracket">
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <input type="number" step="0.01" required class="form-control form-control-user" name="from"
                                            placeholder="From">
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <input type="number" step="0.01" required class="form-control form-control-user" name="to"
                                            placeholder="To">
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <input type="number" step="0.01" required class="form-control form-control-user" name="percentage"
                                            placeholder="Percentage">
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <input type="number" step="0.01" required class="form-control form-control-user" name="fixed_tax"
                                            placeholder="Fixed Tax">
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
