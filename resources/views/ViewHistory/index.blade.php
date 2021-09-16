@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">  

@section('title')
    Viewed History
@endsection

@section('headername')
    Viewed History
@endsection

@section('content')

						
    <!-- Feed Activity -->
    <div class="card  card-table flex-fill">
        <div class="card-header">
            
            <h4 class="card-title"> View History of Search Items By Users</h4>
        </div>
        <br>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="mytable" style="width: 100%">
                    <thead>
                        <tr>		
                            <th>ID</th>											
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>User Name</th>
                            <th>Search Date</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
   
    <!-- /Feed Activity -->
    
</div>



@endsection

@section('scripts')
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script> 
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
    var table =  $('#mytable').DataTable({
        "scrollX": true,
        "ordering":false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('viewhistory.getData') }}",
            "type": "GET"
        },
       
        "columns":[
            { "data": "id" },
            { "data": "item_code" },
            {"data": "item_name" },
            { "data": "name" },
            { "data": "date" },
            // {data: 'action', name: 'action', orderable: false, searchable: false}

           
        ],
     
   
     });

    
});
           
    
    </script>
@endsection