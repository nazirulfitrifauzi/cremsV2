@extends('layouts.app', ['title' => 'Client Management'])

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
    @include('users.partials.header', ['title' => 'Users List'])  

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow" style="padding-bottom:20px;">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">All Client List</h3>
                            </div>
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
                        <table id="staff_table" class="table align-items-center table-flush" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Company</th>
                                    <th scope="col"></th>
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

    var table_staff = $('#staff_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('Ajax.getClientUser') }}"
        },
        "columns":[
            { "data": "name"},
            { "data": "email"},
            { "data": "client_name"},
            { render:function(data, type, row){
                return   '<div style="float:right;">' +              
                        '<a class="btn btn-success" href="client-user/'+ row.id +'/edit" style="padding:5px;">' +
                            '<i class="fas fa-edit" style="margin-right:0px;"></i> Edit' +
                            '<div class="ripple-container"></div>' +
                        '</a>' +
                        '<a class="btn btn-danger" onclick="deleteclient('+ row.id +')" style="padding:5px;color:white;">' +
                            '<i class="fas fa-times-circle" style="margin-right:0px;color:white;"></i> Delete' +
                            '<div class="ripple-container"></div>' +
                        '</a>' +
                        '</div>'
                }, "sortable":false, "searchable":false
            },
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
        table_staff.search($('#search').val()).draw();
    } );

});
</script>
<script>
    function deleteclient(id) {
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
                    url: "{{ url('client-user') }}/" + id,
                    data: {'_token' : CSRF_TOKEN, '_method' : 'DELETE'},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            Swal.fire(
                                "Done!",results.message,"success"
                            ).then(function() {
                                window.location = "{{ url('client-list')}}";
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