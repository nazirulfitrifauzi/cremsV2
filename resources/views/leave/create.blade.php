@extends('layouts.app', ['title' => 'Staff Leave'])

@section('content')
    @include('users.partials.header', ['title' => 'Apply Leave'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Apply New Leave</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('staff-leave.index') }}" class="btn btn-sm btn-primary">Go to Calendar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('staff-leave.store') }}">
                            @csrf

                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="type">Leave Type</label>
                                    <select name="type" id="type" class="form-control form-control-alternative" required="">
                                        <option value="AL">Annual Leave</option>
                                        <option value="MC">Medical Leave</option>
                                        <option value="EL">Emergency Leave</option>
                                        <option value="UP">Unpaid Leave</option>
                                        <option value="CL">Compassionate Leave</option>
                                        <option value="M">Maternity Leave</option>
                                        <option value="P">Paternity Leave</option>
                                        <option value="X">Unrecorded Leave</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="title">Reason</label>
                                    <input type="text" name="title" id="title" class="form-control form-control-alternative" placeholder="Reason" required="">
                                </div>
                                <div class="input-daterange datepicker row align-items-center">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="start">From</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="Start date" type="text" name="start" value="{{ now()->format('m/d/Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="end">To</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="End date" type="text" name="end" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox mb-3" style="margin-left: 15px !important;">
                                        <input class="custom-control-input" id="halfday" name="halfday" type="checkbox" value="1">
                                        <label class="custom-control-label" for="halfday">Half Day</label>
                                    </div>
                                    &nbsp;&nbsp;
                                    <div class="custom-control custom-checkbox mb-3" id="amdiv" style="display:none;">
                                        <input class="custom-control-input" id="am" name="am" type="checkbox" value="1">
                                        <label class="custom-control-label" for="am">AM</label>
                                    </div>
                                    &nbsp;&nbsp;
                                    <div class="custom-control custom-checkbox mb-3" id="pmdiv" style="display:none;">
                                        <input class="custom-control-input" id="pm" name="pm" type="checkbox" value="1">
                                        <label class="custom-control-label" for="pm">PM</label>
                                    </div>
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

@push('js')
<script>
    $(function() {
        $("#halfday").click(function() {
            if ($(this).is(":checked")) {
            $("#amdiv").show();
            $("#pmdiv").show();
            } else {
            $("#amdiv").hide();
            $("#pmdiv").hide();
            }
        });
    });
</script>
@endpush