@extends('layouts.app', ['title' => 'Advance'])

@section('style')
<style>
.dataTables_info {
	font-size: .75rem;
	padding-top: .25rem;
	padding-bottom: .25rem;
	letter-spacing: .04em;
	text-transform: uppercase;
    color: #8898aa !important;
    padding-left: 20px;
}
.dataTables_paginate {
    padding-right: 20px;
}
</style>
@endsection

@section('content')
    @if (auth()->user()->role == '1')
        @include('layouts.headers.hr')  
    @else  
        @include('users.partials.header', ['title' => 'Advance List'])  
    @endif

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow" style="padding-bottom:20px;">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                            <h3 class="mb-0">{{ now()->format('Y') }} Advance List</h3>
                            </div>
                            @if (auth()->user()->role == '1')
                            @else
                                <div class="col-4 text-right">
                                    <a href="{{ route('staff-claim.create') }}" class="btn btn-sm btn-primary">Apply Advance</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-0" style="padding: 10px 30px;">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input class="form-control" placeholder=" Search" type="text" id="search">
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="claim_table" class="table align-items-center table-flush" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Amount (RM)</th>
                                    <th scope="col">Date / Time</th>
                                    <th scope="col">Status</th>
                                    @if (auth()->user()->role == '1')
                                        <th scope="col">Action</th>
                                    @endif
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script>
$(document).ready(function(){

    @if (is_null(auth()->user()->staff_id))
    @else
        var staff_id = {{ (Auth::user()->staff_id) }};
    @endif

    var table_claim = $('#claim_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[ 3, "desc"]],
        "ajax": {
            @if (auth()->user()->role == '1')
                "url": "{{ route('Ajax.getStaffClaimAll') }}"
            @else
                "url": "{{ route('Ajax.getStaffClaim') }}?staff_id=" + staff_id
            @endif
        },
        "columns":[
            { "data": "staff_id" },
            { "data": "type"},
            { "data": "amt"},
            { "data": "date"},
            { render:function(data,type,row){
                    if(row.status == '0')
                    {
                        return '<span class="badge badge-pill badge-warning">Pending</span>'
                    }
                    else if(row.status == '1' && row.approved == '1')
                    {
                        return '<span class="badge badge-pill badge-success">Approved</span>'
                    }
                    else if(row.status == '1' && row.approved == '0')
                    {
                        return '<span class="badge badge-pill badge-danger">Rejected</span>'
                    }
                }, "sortable":false, "searchable":false
            },
            @if (auth()->user()->role == '1')
                { render:function(data,type,row){
                        if(row.status == '0')
                        {
                            return '<div>' +              
                                        '<a class="btn btn-primary" href="staff-claim/'+ row.id +'" target="_blank" style="padding:5px;">' +
                                            '<i class="fas fa-eye" style="margin-right:0px;"></i> Show' +
                                            '<div class="ripple-container"></div>' +
                                        '</a>' +
                                        '<a class="btn btn-success" href="staff-claim/'+ row.id +'/edit" style="padding:5px;">' +
                                            '<i class="fas fa-check-circle" style="margin-right:0px;"></i> Approve' +
                                            '<div class="ripple-container"></div>' +
                                        '</a>' +
                                        '<a class="btn btn-danger" onclick="deleteStaffClaim(' + row.id + ')" style="padding:5px;color:white;">' +
                                            '<i class="fas fa-times-circle" style="margin-right:0px;color:white;"></i> Reject' +
                                            '<div class="ripple-container"></div>' +
                                        '</a>' +
                                    '</div>'
                        }
                        else if(row.status == '1' && row.approved == '1')
                        {
                            return '<div>' +              
                                        '<a class="btn btn-primary" href="staff-claim/'+ row.id +'" target="_blank" style="padding:5px;">' +
                                            '<i class="fas fa-eye" style="margin-right:0px;"></i> Show' +
                                            '<div class="ripple-container"></div>' +
                                        '</a>' +
                                    '</div>'
                        }
                        else if(row.status == '1' && row.approved == '0')
                        {
                            return '<div>' +              
                                        '<a class="btn btn-primary" href="staff-claim/'+ row.id +'" target="_blank" style="padding:5px;">' +
                                            '<i class="fas fa-eye" style="margin-right:0px;"></i> Show' +
                                            '<div class="ripple-container"></div>' +
                                        '</a>' +
                                    '</div>'
                        }
                    }, "sortable":false, "searchable":false
                }
            @endif
        ],
        "language": {
            "paginate": {
                "previous": "&lt;",
                "next": "&gt;"
            }
        },
        "bLengthChange": false,
        "dom": "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    });

    $('#search').on( 'change', function () {
        table_claim.search($('#search').val()).draw();
    } );

});
</script>
<script>
    function deleteStaffClaim(id) {
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
                    url: "{{ url('staff-claim')}}" + '/' + id,
                    data: {'_token' : CSRF_TOKEN, '_method' : 'DELETE'},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            Swal.fire(
                                "Done!",results.message,"success"
                            ).then(function() {
                                window.location = "{{ url('staff-claim')}}";
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

    @if (Session::has('success'))
    <script>
        demo.showNotification("bottom","right","done","{{ Session::get('success') }}","success");
    </script>
    @endif
@endpush