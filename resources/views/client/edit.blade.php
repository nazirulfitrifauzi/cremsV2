@extends('layouts.app', ['title' => 'Client Management'])

@section('content')
    @include('users.partials.header', ['title' => 'Edit Client'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Client Information</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('client.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            {{-- client form --}}
                            <form method="post" action="{{ route('client.update', $client->id) }}" autocomplete="off">
                                @csrf
                                @method('put')

                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="client_name">Client Name</label>
                                    <input type="text" name="client_name" id="client_name" class="form-control form-control-alternative{{ $errors->has('client_name') ? ' is-invalid' : '' }}" placeholder="Client Name" value="{{ $client->client_name }}" required autofocus>

                                        @if ($errors->has('client_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('client_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Client Address</label>
                                        <textarea name="address" id="address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Client Address" required="">{{ $client->address }}</textarea>

                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
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