@extends('layouts.app', ['title' => 'Issues Management'])

@section('content')
    @include('users.partials.header', ['title' => 'Issues Details'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Issues Status</h3>
                            </div>
                            <div class="col-4 text-right">
                              <a href="{{ route('issues.assign') }}" class="btn btn-sm btn-primary">Assign Staff</a>
                              <a href="{{ route('issues.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                          </div>
                        </div>
                    </div>
                    <h6 class="heading-small text-muted mb-4">Issue information</h6>
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Issues</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Issue Subject</th>
                                    <th scope="col">Issue Description</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Issues as $issue)
                                    <tr>
                                        <td>{{ $issue->subject }}</td>
                                        <td>{{ $issue->name }}</td>
                                        <td>{{ $issue->date }}</td>
                                        <td>{{ $issue->subject }}</td>
                                        <td>{{ $issue->description }}</td>
                                      
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h6 class="heading-small text-muted mb-4">Solver</h6>
                    <div class="table-responsive">
                      <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                              <tr>
                                  <th scope="col">Issues</th>
                                  <th scope="col">Software Engineer</th>
                                  <th scope="col">Status</th>
                                 

                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($Issues as $issue)
                                  <tr>
                                      <td>{{ $issue->subject }}</td>
                                      <td>{{ $issue->names }}</td>
                                      <td>{{ $issue->status }}</td>
                                      
                                     
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>

                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $Issues->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection