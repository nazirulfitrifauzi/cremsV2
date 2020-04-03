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


                    <body>
                        <style>
                         .css{
                                display: block;
                            
                            }
                        </style>

                        <span class=css><b>Name</b></span>
                        <span class=css>{{ $issue->name }}</span>

                        <br>
                    
                        <span class=css><b>Email</b></span>
                        <span class=css>{{ $issue->email }}</span>

                        <br>

                        <span class=css><b>Issue Subject</b></span>
                        <span class=css>{{ $issue->subject }}</span>

                        <br>

                        <span class=css><b>Issue Description</b></span>
                        <span class=css>{{ $issue->description }}</span>

                        <br>

                        <span class=css><b>Date of Issue</b></span>
                        <span class=css>{{ $issue->date->format('d/m/Y')}}</span>

                        <br>

                        <span class=css><b>Staff Assigned</b></span>
                        <span class=css>{{ $issue->staffAssigned }}</span>

                        <br>

                        <span class=css><b>Status</b></span>
                        <span class=css>{{ $issue->status }}</span>

                        <br>
                
                    </body>
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