@extends('layouts.app', ['title' => 'Issues Management'])

@section('content')

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
    @include('users.partials.header', ['title' => 'Issues List'])  

    
    <div class="container-fluid mt--7">
      <div class="row">
          <div class="col-xl-12 order-xl-1">
              <div class="card bg-secondary shadow">
                  <div class="card-header bg-white border-0">
                      <div class="row align-items-center">
                          <div class="col-8">
                              <h3 class="mb-0">Add New Issue</h3>
                          </div>
                          <div class="col-4 text-right">
                              <a href="{{ route('issues.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <form method="post" action="{{ route('issues.store') }}">
                          @csrf

                          <h6 class="heading-small text-muted mb-4">Issue information</h6>
                          <div class="pl-lg-4">
                              <div class="form-group">
                                  <label class="form-control-label" for="input-name">Name</label>
                                  <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="Name" value="{{ old('name') }}" required="" autofocus="">
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-control-label" for="input-start-work">Issue Date</label>
                                          <div class="input-group input-group-alternative">
                                              <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                              </div>

                                          <input class="form-control form-control-alternative datepicker" name="date" placeholder="Select date" type="text" value="{{ now()->format('d/m/Y') }}" required>
                                          </div>
                                      </div>
                                  </div>
                                  
                              </div>

                              <div class="form-group">
                                <label class="form-control-label" for="input-name">Issue Subject</label>
                                <input type="text" name="subject" id="input-subject" class="form-control form-control-alternative" placeholder="Issue Subject" value="" required="">
                            </div> 

                            <div class="form-group">
                              <label class="form-control-label" for="input-name">Issue Description</label>
                              <input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="Issue Description" value="" required="">
                          </div> 

                              <div class="form-group">
                                  <label class="form-control-label" for="input-email">Email</label>
                                  <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="Email" value="{{ old('email') }}" required="">
                              </div>
                              <div class="form-group">
                                    <label class="form-control-label" for="staffAssigned">Assign Staff</label>
                                        <select name="staffAssigned" id="staffAssigned" class="form-control form-control-alternative" required="">
                                            <option value="Unassigned">Unassigned</option>
                                            <option value="Nazirul">Nazirul</option>
                                            <option value="Aizuddin">Aizuddin</option>
                                            <option value="Anis">Anis</option>
                                            <option value="Safwan">Safwan</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="status">Status</label>
                                        <select name="status" id="status" class="form-control form-control-alternative" required="">
                                            <option value="Unsolved">Unsolved</option>
                                            <option value="Solved">Solved</option>
                                        </select>
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