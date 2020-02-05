@extends('layouts.app', ['title' => 'Role Management'])

@section('content')
    @include('users.partials.header', ['title' => 'Edit Role'])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Roles Management</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('roles.update', $role) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">Role Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Role Name</label>
                                    <input type="text" name="role" id="input-name" class="form-control form-control-alternative{{ $errors->has('role') ? ' is-invalid' : '' }}" placeholder="Role" value="{{ old('role', $role->role) }}" required autofocus>

                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <br>

                                <h6 class="heading-small text-muted mb-4" style="padding-bottom: 0px;padding-top: 0px;line-height: 0px;">Human Resource</h6>
                                
                                <table width="100%">
                                    <tr>
                                        <td width="25%">
                                            <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="attendance" name="p_attendance" type="checkbox" value="1" {{ ($role->p_attendance == '1') ? 'checked="true"' : '' }}>
                                                <label class="custom-control-label" for="attendance">Attendance</label>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" id="leave" name="p_leave" type="checkbox" value="1" {{ ($role->p_leave == '1') ? 'checked="true"' : '' }}>
                                                <label class="custom-control-label" for="leave">Leave</label>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" id="claim" name="p_claim" type="checkbox" value="1" {{ ($role->p_claim == '1') ? 'checked="true"' : '' }}>
                                                <label class="custom-control-label" for="claim">Claim</label>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" id="advance" name="p_advance" type="checkbox" value="1" {{ ($role->p_advance == '1') ? 'checked="true"' : '' }}>
                                                <label class="custom-control-label" for="advance">Advance</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <br>

                                <h6 class="heading-small text-muted mb-4" style="padding-bottom: 0px;padding-top: 0px;line-height: 0px;">Settings</h6>
                                
                                <table width="100%">
                                    <tr>
                                        <td width="25%">
                                            <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="roles" name="p_roles" type="checkbox" value="1" {{ ($role->p_roles == '1') ? 'checked="true"' : '' }}>
                                                <label class="custom-control-label" for="roles">Roles</label>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="staff" name="p_staff" type="checkbox" value="1" {{ ($role->p_staff == '1') ? 'checked="true"' : '' }}>
                                                <label class="custom-control-label" for="staff">Staff</label>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="client_company" name="p_client_company" type="checkbox" value="1" {{ ($role->p_client == '1') ? 'checked="true"' : '' }}>
                                                <label class="custom-control-label" for="client_company">Company List</label>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="client_user" name="p_client_user" type="checkbox" value="1" {{ ($role->p_client_user == '1') ? 'checked="true"' : '' }}>
                                                <label class="custom-control-label" for="client_user">Users</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

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