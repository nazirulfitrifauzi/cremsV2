@extends('layouts.app', ['title' => 'Client Management'])

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
    @include('users.partials.header', ['title' => 'Client List'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Add New Client</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('client.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('client.store') }}">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Client information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-client_name">Client Name</label>
                                    <input type="text" name="client_name" id="input-client_name" class="form-control form-control-alternative" placeholder="Client Name" value="{{ old('client_name') }}" required="" autofocus="">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-address">Email</label>
                                    <textarea name="address" id="input-address" class="form-control form-control-alternative" placeholder="Address" required="">{{ old('address') }}</textarea>
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