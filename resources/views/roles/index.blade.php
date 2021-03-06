@extends('layouts.app', ['title' => 'Roles Management'])

@section('content')
    @include('users.partials.header', ['title' => 'Role List'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Roles</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">Add Role</a>
                            </div>
                        </div>
                    </div>
                    
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
                                    <th scope="col">Roles</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->role }}</td>
                                        <td class="text-right">
                                            <div class="row" style="float:right;margin-right:5px;">
                                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-default"><i class="ni ni-settings"></i></a>
                                                <a onclick="deleteData({{ $role->id }})" style="color:white;" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $roles->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script>
    function deleteData(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: "warning",
            confirmButtonColor: '#2dce89',
            cancelButtonColor: '#f5365c',
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!"
        }).then(function (e) {
  
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
                $.ajax({
                    type: 'POST',
                    url: "{{ url('roles')}}" + '/' + id,
                    data: {'_token' : CSRF_TOKEN, '_method' : 'DELETE'},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            Swal.fire(
                              "Done!",results.message,"success"
                            ).then(function() {
                              window.location = "{{ url('roles')}}";
                            });
                        } else {
                            swal("Error!", results.message, "error");
                        }
                    }
                });
  
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    }
  </script>
@endpush