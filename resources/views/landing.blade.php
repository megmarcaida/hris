@extends('auth.layouts.app')

@section('content')
<div class="row justify-content-center" style="margin-top: 10em;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h1 text-gray-900 mb-4">HRIS</h1>
                                        <h4 clsas="h4 text-gray-900 mb-4">Welcome Back!</h4>
                                        
                                        @if ($success)
                                            <div class="alert alert-success">
                                                    {{ $success }} <br> {{ $time }}
                                            </div>
                                        @endif
                                        @if($error)
                                            <div class="alert alert-danger">
                                                    {{ $error }}
                                            </div>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('attendance') }}">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <input placeholder="Card No" type="text" class="form-control" name="unique_id" required autofocus>
                                            <br>
                                            <textarea placeholder="Reason" type="text" class="form-control" name="Memoinfo" required autofocus></textarea>
                                            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" name="time_in" class="btn btn-primary btn-block">
                                            {{ __('Time In / Out') }}
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
@endsection
