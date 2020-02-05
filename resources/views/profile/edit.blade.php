@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => 'Hello' . ' '. auth()->user()->name,
        'description' => 'This is your profile page. You need to fill in User Information so that this system can do it\'s magic.',
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img id="avatar" src="{{ asset('storage') }}/Avatar/{{auth()->user()->avatar}}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <form method="post" name="avatar_form" id="avatar_form" action="{{ route('avatar.change') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                <a href="#" id="avatar-button" class="btn btn-sm btn-default float-right">Change</a> 
                                <input type="file" name="avatar" id="my_file" style="display: none;" />
                                <button type="submit" id="save_avatar" class="btn btn-sm btn-success float-right" style="display:none">Save</button> 
                            </div>
                        </div>
                    </form>

                    <div class="card-body pt-0 pt-md-4" style="margin-top: 35px;">
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}
                                <br>

                                @if (is_null(auth()->user()->staff_id))
                                    
                                @else
                                    <span class="font-weight-light">
                                        <i class="fas fa-birthday-cake"></i> <span id="age"></span>
                                    </span>
                                @endif
                            </h3>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ (!is_null(auth()->user()->staff_id)) ? auth()->user()->staff_info->designation : 'Client' }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ (!is_null(auth()->user()->staff_id)) ? 'Creative System Consultant' : auth()->user()->client_info->client_name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">

                        @if (is_null(auth()->user()->staff_id)) 
                            {{-- client form --}}
                            <form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email</label>
                                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="Email" value="{{ old('email', $info->email) }}" required="">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>

                        @else
                            <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                                @csrf
                                @method('put')

                                <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $info->name) }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <textarea name="address" id="input-address" class="form-control form-control-alternative" placeholder="Address" required="">{{ old('address', $info->address) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-icno">IC No</label>
                                                <input type="text" name="icno" id="input-icno" class="form-control form-control-alternative" placeholder="IC No" value="{{ old('icno', $info->icno) }}" required="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-mobile">Mobile No</label>
                                                <input type="text" name="mobile" id="input-mobile" class="form-control form-control-alternative" placeholder="Mobile No" value="{{ old('mobile', $info->mobile) }}" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-phone">Phone No</label>
                                                <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative" placeholder="Phone No" value="{{ old('phone', $info->phone) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-personal-email">Personal Email</label>
                                                <input type="email" name="personal_email" id="input-personal-email" class="form-control form-control-alternative" placeholder="Personal Email" value="{{ old('personal_email', $info->personal_email) }}" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email</label>
                                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="Email" value="{{ old('email', $info->email) }}" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>

                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
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
    <script>
        $(document).ready(function(){
            findBirthday();
            $('#input-icno').keyup(function() {
                findBirthday();
            });
        });

        $("#avatar-button").click(function() {
            $("input[id='my_file']").click();
        });

        $("input[id='my_file']").on('change', function(){
            readURL(this);
            checkFiles();
        });

        var checkFiles = function () {
            if( document.getElementById("my_file").files.length > 0 ){
                $('#save_avatar').css('display', '');
            } else {
                $('#save_avatar').css('display', 'none');
            }
        }

        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        function findBirthday() {
            var ic = $('#input-icno').val();

            if(ic.match(/^(\d{2})(\d{2})(\d{2})-?\d{2}-?\d{4}$/)) {
                var year = RegExp.$1;
                var month = RegExp.$2;
                var day = RegExp.$3;

                var date = new Date(year,month,day);
                var dd = date.getDate();
                var mm = date.getMonth(); 
                var yyyy = date.getFullYear();
                
                if(dd<10) 
                {
                    dd='0'+dd;
                } 

                if(mm<10) 
                {
                    mm='0'+mm;
                } 

                var d = new Date(yyyy+'-'+mm+'-'+dd);
                var month = new Array();
                month[0] = "January";
                month[1] = "February";
                month[2] = "March";
                month[3] = "April";
                month[4] = "May";
                month[5] = "June";
                month[6] = "July";
                month[7] = "August";
                month[8] = "September";
                month[9] = "October";
                month[10] = "November";
                month[11] = "December";

                var n = month[d.getMonth()];

                $('#age').html(dd+' '+n); // get birth date
            }
            else{
                $('#age').val('IC number is invalid.');
            }
        }
    </script>

    @if (Session::has('success'))
    <script>
        demo.showNotification("bottom","right","done","{{ Session::get('success') }}","success");
    </script>
    @endif    
@endpush