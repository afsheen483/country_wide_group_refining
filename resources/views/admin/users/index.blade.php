{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css"> 

@section('title', 'Users')

@section('content')

<div class="col-lg-12 col-lg-offset-1">
    <h1><i class="fa fa-users"></i> User Administration <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="mytable" style="width: 100%">

            <thead>
                <tr>
                    {{-- <th>User ID</th> --}}
                    <th>Name</th>
                    <th>Username or Email</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Postal Code</th>
                    <th>Phone Number</th>
                    <th>Date/Time Added</th>
                    <th>User Roles</th>
                   
                </tr>
            </thead>

            <tbody></tbody>
           
        </table>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>

</div>

@endsection

@section('scripts')
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>    
        <script>
$(document).ready(function() {
//     $('#mytable tfoot th').each(function() {
//     var title = $(this).text();
//     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
//   });
    var table =  $('#mytable').DataTable({
        "scrollX": true,
      
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('ajaxdata.getdata') }}",
            "type": "GET"
        },
       
        "columns":[
            { "data": "first_name" },
            { "data": "email" },
            { "data": "address" },
            { "data": "city_name"},
            { "data": "province" },
            { "data": "postal_code" },
            { "data": "phone_num" },
            { "data": "created_at" },
            { "data": "updated_at" },
          
        ],
    //     initComplete: function() {
    //   var api = this.api();

    //   // Apply the search
    //   api.columns().every(function() {
    //     var that = this;

    //     $('input', this.footer()).on('keyup change', function() {
    //       if (that.search() !== this.value) {
    //         that
    //           .search(this.value)
    //           .draw();
    //       }
    //     });
    //   });
    // }
     });
    

 
});
           
    </script>
@endsection