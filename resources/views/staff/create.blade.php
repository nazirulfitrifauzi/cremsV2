@extends('layouts.app', ['title' => 'Staff Management'])

@section('style')
<style>
.dataTables_info {
	font-size: .75rem;
	padding-top: .25rem;
	padding-bottom: .25rem;
	letter-spacing: .04em;
	text-transform: uppercase;
    color: #8898aa !important;
    padding-left: 20px;
}
.dataTables_paginate {
    padding-right: 20px;
}
</style>
@endsection

@section('content')
    @include('users.partials.header', ['title' => 'Staff List'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Add New Staff</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('staff.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('staff.store') }}">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Staff information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="Name" value="{{ old('name') }}" required="" autofocus="">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-start-work">Start Work Date</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                            <input class="form-control form-control-alternative datepicker" name="start_date" placeholder="Select date" type="text" value="{{ now()->format('m/d/Y') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-designation">Designation</label>
                                            <input type="text" name="designation" class="form-control form-control-alternative" placeholder="Designation" value="" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-csc-email">Email</label>
                                    <input type="email" name="csc_email" id="input-csc-email" class="form-control form-control-alternative" placeholder="Email" value="{{ old('csc_email') }}" required="">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-password">Password</label>
                                            <input type="password" name="password" id="input-password" class="form-control form-control-alternative" placeholder="Password" value="" required="">
                                        </div>

                                        @if ($errors->has('password'))
                                            <span style="display: contents;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-password-confirmation">Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="Confirm Password" value="" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection