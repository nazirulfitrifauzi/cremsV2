@extends('layouts.app', ['title' => 'Company'])

@section('content')
    @include('users.partials.header', ['title' => 'Company Setting'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Company Information</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            {{-- Company form --}}
                            <form method="post" action="{{ route('company.update', $company->id) }}" autocomplete="off">
                                @csrf
                                @method('put')

                                <div>
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="name">Company Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Company Name" value="{{ $company->name }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Company Address</label>
                                        <textarea name="address" id="address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Company Address" required="">{{ $company->address }}</textarea>

                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('comp_no') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="comp_no">Company No</label>
                                                <input type="text" name="comp_no" id="comp_no" class="form-control form-control-alternative{{ $errors->has('comp_no') ? ' is-invalid' : '' }}" placeholder="Company No" value="{{ $company->comp_no }}" required autofocus>
        
                                                @if ($errors->has('comp_no'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('comp_no') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('tax_no') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="tax_no">Tax No</label>
                                                <input type="text" name="tax_no" id="tax_no" class="form-control form-control-alternative{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" placeholder="Tax No" value="{{ $company->tax_no }}" autofocus>
        
                                                @if ($errors->has('tax_no'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('tax_no') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="phone">Phone No</label>
                                                <input type="text" name="phone" id="phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Company Phone No" value="{{ $company->phone }}" required autofocus>
        
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('fax') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="fax">Fax No</label>
                                                <input type="text" name="tax_no" id="fax" class="form-control form-control-alternative{{ $errors->has('fax') ? ' is-invalid' : '' }}" placeholder="Company Fax No" value="{{ $company->fax }}" autofocus>
        
                                                @if ($errors->has('fax'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('fax') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">Update</button>
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

@push('js')
    @if (Session::has('success'))
    <script>
        demo.showNotification("bottom","right","done","{{ Session::get('success') }}","success");
    </script>
    @endif    
@endpush