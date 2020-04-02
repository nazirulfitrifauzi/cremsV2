@extends('layouts.app', ['title' => 'Issue Management'])

@section('content')
    @include('users.partials.header', ['title' => 'Issue Detail'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Issue Information</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('issues.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Issue Subject</th>
                                    <th scope="col">Issue Description</th>
                                    <th scope="col">Date of Issue</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>{{ $issue->name }}</td>
                                    <td>{{ $issue->email }}</td>
                                    <td>{{ $issue->subject }}</td>
                                    <td>{{ $issue->description }}</td>
                                    <td>{{ $issue->date->format('d/m/Y')}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Staff Assigned</th>
                                    <th scope="col">Status</th>
                                    
                                   

                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>{{ $issue->staffAssigned }}</td>
                                    <td>{{ $issue->status }}</td>
                                    
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>

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