@extends('layouts.app', ['title' => 'Advance'])

@section('content')
    @include('users.partials.header', ['title' => 'Apply Advance'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Advance Application</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('staff-advance.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('staff-advance.store') }}">
                            @csrf

                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="amt">Amount</label>
                                    <table width="100%">
                                        <tr>
                                            <td width="3%">
                                                <label class="form-control-label" style="margin-bottom: 0rem;">RM</label>
                                            </td>
                                            <td width="15%">
                                                <input type="text" data-type="number" name="amt" id="amt" class="form-control form-control-alternative" placeholder="0.00" required="">
                                            </td>
                                            <td width="5%" align="center">
                                                <i class="fas fa-equals"></i>
                                            </td>
                                            <td width="3%">
                                                <label class="form-control-label" style="margin-bottom: 0rem;">RM</label>
                                            </td>
                                            <td width="10%">
                                                <input type="text" data-type="number" name="month_deduct" id="month_deduct" class="form-control form-control-alternative" placeholder="0.00" required="">
                                            </td>
                                            <td width="3%">
                                                <a id="popoverOption" href="#" data-content="Monthly deduction" rel="popover" data-placement="bottom" style="margin-left:10px;"><i class="far fa-question-circle"></i></a>
                                            </td>
                                            <td width="5%" align="center">
                                                <i class="fas fa-times"></i>
                                            </td>
                                            <td width="10%">
                                                <input type="number" name="month_duration" id="month_duration" class="form-control form-control-alternative" placeholder="months" max="60" required="">
                                            </td>
                                            <td width="10%">
                                                <label class="form-control-label" style="margin-left: 10px;margin-bottom: 0rem;">Months</label>
                                                <a id="popoverOption2" href="#" data-content="Cannot exceed 60 months / 5 years." rel="popover" data-placement="bottom"><i class="far fa-question-circle"></i></a>
                                            </td>
                                            <td width="30%">
                                                <button type="submit" class="btn btn-primary" name="action" value="schedule" formtarget="_blank" style="float:right;">Generate Repayment Schedule</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="remarks">Remarks</label>
                                    <input type="text" name="remarks" id="remarks" class="form-control form-control-alternative" placeholder="Remarks">
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" id="advance" name="p_advance" type="checkbox" value="1">
                                    <label class="custom-control-label" for="advance">I hereby agreed with the <a href="">terms and conditions</a>.</label>
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" id="advance" name="p_advance" type="checkbox" value="1">
                                    <label class="custom-control-label" for="advance">I hereby agreed that the amount applied above, if approved, shall be payable via monthly deduction based on the generated repayment schedule.</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4" name="action" value="store">Submit</button>
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
        $('#popoverOption').popover({
            trigger: "hover"
        });

        $('#popoverOption2').popover({
            trigger: "hover"
        });

        $(document).ready(function(){
            $("input[data-type='number']").keyup(function(event){
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                    event.preventDefault();
                }
                var $this = $(this);
                var num = $this.val().replace(/,/gi, "");
                var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
                // the following line has been simplified. Revision history contains original.
                $this.val(num2);
            });

            document.getElementById("amt").addEventListener("keyup", calculateDefault);
            document.getElementById("month_deduct").addEventListener("keyup", calculateMonth);
            document.getElementById("month_duration").addEventListener("keyup", calculateInstallment);
        });

        function calculateDefault() {
            var total = parseFloat(document.getElementById('amt').value.replace(/,/g, ''));
            
            document.getElementById('month_deduct').value = (Math.round((total/12) * 100) / 100).toFixed(2);
            document.getElementById('month_duration').value = 12;
        }

        function calculateMonth() {
            var total = parseFloat(document.getElementById('amt').value.replace(/,/g, ''));
            var installment = parseFloat(document.getElementById('month_deduct').value.replace(/,/g, ''));
            
            document.getElementById('month_duration').value = (Math.round((total/installment) * 100) / 100).toFixed(2);
        }

        function calculateInstallment() {
            var total = parseFloat(document.getElementById('amt').value.replace(/,/g, ''));
            var month = parseFloat(document.getElementById('month_duration').value.replace(/,/g, ''));
            
            document.getElementById('month_deduct').value = (Math.round((total/month) * 100) / 100).toFixed(2);
        }
    </script>
    @if (Session::has('success'))
    <script>
        demo.showNotification("bottom","right","done","{{ Session::get('success') }}","success");
    </script>
    @endif
@endpush