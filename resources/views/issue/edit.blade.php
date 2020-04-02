@extends('layouts.app', ['title' => 'Issues Management'])

@section('content')
    @include('users.partials.header', ['title' => 'Edit Issues'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Issues</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('issues.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            {{-- client form --}}
                            <form method="post" action="{{ route('issues.update', $issue->id) }}" autocomplete="off">
                                @csrf
                                @method('put')

                               
                                <div class="pl-lg-4">
                                  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ $issue->name }}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-start-work">Issue Date</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                
                                            <input class="form-control form-control-alternative datepicker" name="date" placeholder="" type="text" value="{{ $issue->date->format('d/m/Y') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                  <div class="form-group">
                                      <label class="form-control-label" for="subject">Issue Subject</label>
                                      <textarea name="subject" id="subject" class="form-control form-control-alternative{{ $errors->has('subject') ? ' is-invalid' : '' }}" placeholder="Issue Subject" required="">{{ $issue->subject }}</textarea>

                                      @if ($errors->has('subject'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('subject') }}</strong>
                                          </span>
                                      @endif
                                  </div>

                                  <div class="form-group">
                                    <label class="form-control-label" for="subject">Issue Description</label>
                                    <textarea name="description" id="description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Issue Description" required="">{{ $issue->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                               
                                 
                                <div class="form-group">
                                          <label class="form-control-label" for="email">Email</label>
                                          <input type="text" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" required="" value="{{ $issue->email }}">
  
                                          @if ($errors->has('email'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('email') }}</strong>
                                              </span>
                                          @endif
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="staffAssigned">Assign Staff</label>
                                        <select name="staffAssigned" id="staffAssigned" class="form-control form-control-alternative" required="">
                                            <option value="Unassigned" {{ $issue->staffAssigned == "Unassigned" ? 'selected' : '' }}>Unassigned</option>
                                            <option value="Nazirul" {{ $issue->staffAssigned == "Nazirul" ? 'selected' : '' }}>Nazirul</option>
                                            <option value="Aizuddin" {{ $issue->staffAssigned == "Aizuddin" ? 'selected' : '' }}>Aizuddin</option>
                                            <option value="Anis" {{ $issue->staffAssigned == "Anis" ? 'selected' : '' }}>Anis</option>
                                            <option value="Safwan" {{ $issue->staffAssigned == "Safwan" ? 'selected' : '' }}>Safwan</option>
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