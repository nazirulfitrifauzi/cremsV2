@extends('layouts.app', ['title' => 'Staff Management'])

@section('content')
    @include('users.partials.header', ['title' => 'Edit Staff'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Staff Information</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('staff.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            {{-- client form --}}
                            <form method="post" action="{{ route('staff.update', $staff->id) }}" autocomplete="off">
                                @csrf
                                @method('put')

                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Staff Name" value="{{ $staff->name }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Staff Address" required="">{{ $staff->address }}</textarea>

                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="icno">IC No</label>
                                                <input type="text" name="icno" id="icno" class="form-control form-control-alternative{{ $errors->has('icno') ? ' is-invalid' : '' }}" placeholder="IC No" required="" value="{{ $staff->icno }}">
        
                                                @if ($errors->has('icno'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('icno') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="personal_email">Personal Email</label>
                                                <input type="text" name="personal_email" id="personal_email" class="form-control form-control-alternative{{ $errors->has('personal_email') ? ' is-invalid' : '' }}" placeholder="Personal Email" required="" value="{{ $staff->personal_email }}">
        
                                                @if ($errors->has('personal_email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('personal_email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="mobile">Mobile Phone</label>
                                                <input type="text" name="mobile" id="mobile" class="form-control form-control-alternative{{ $errors->has('mobile') ? ' is-invalid' : '' }}" placeholder="Mobile Phone" required="" value="{{ $staff->mobile }}">
        
                                                @if ($errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('mobile') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="phone">Phone No</label>
                                                <input type="text" name="phone" id="phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Phone No" value="{{ $staff->phone }}">
        
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" required="" value="{{ $staff->email }}">
        
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-start-work">Start Work Date</label>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                <input class="form-control form-control-alternative datepicker" name="start_date" placeholder="Select date" type="text" value="{{ $staff->start_date->format('m/d/Y') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="designation">Designation</label>
                                        <input type="text" name="designation" id="designation" class="form-control form-control-alternative{{ $errors->has('designation') ? ' is-invalid' : '' }}" placeholder="Designation" required="" value="{{ $staff->designation }}">

                                        @if ($errors->has('designation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                        @endif
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