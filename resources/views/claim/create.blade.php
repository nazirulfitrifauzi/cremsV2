@extends('layouts.app', ['title' => 'Claim'])

@section('content')
    @include('users.partials.header', ['title' => 'Claim Request'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Claim Request</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('staff-claim.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('staff-claim.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="type">Claim Type</label>
                                            <select name="type" id="type" class="form-control form-control-alternative" required="">
                                                <option value="medical">Medical</option>
                                                <option value="others">Othres</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="amt">Amount</label>
                                            <input type="number" step="0.01" name="amt" id="amt" class="form-control form-control-alternative" placeholder="0.00" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="remarks">Remarks</label>
                                            <input type="text" name="remarks" id="remarks" class="form-control form-control-alternative" placeholder="Remarks">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="attachmnt">Attachment</label>
                                            <input type="file" name="attachment" id="my_file" style="display:none">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="test" readonly placeholder="Upload Receipt" aria-label="Upload File">
                                                <div class="input-group-append">
                                                <span class="browse input-group-text btn btn-primary" id="attach-button">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div-uploaded">
                                    <label class="form-control-label" >Uploaded Receipt</label><br>
                                    <img id="uploaded" src="" style="height:250px;">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Submit</button>
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
        checkFiles();
    });
    
    var checkFiles = function () {
        if( document.getElementById("my_file").files.length > 0 ){
            $('#div-uploaded').css('display', '');
        } else {
            $('#div-uploaded').css('display', 'none');
        }
    }

    var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#uploaded').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    $("#attach-button").click(function() {
            $("input[id='my_file']").click();
        });

    $(document).on("change", "#my_file", function() {
        $(this)
        .parent()
        .find(".form-control")
        .val(
        $(this)
            .val()
            .replace(/C:\\fakepath\\/i, "")
        );
        readURL(this);
        checkFiles();
    });
</script>
@if (Session::has('success'))
<script>
    demo.showNotification("bottom","right","done","{{ Session::get('success') }}","success");
</script>
@endif
@endpush