@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">  
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> --}}

@section('title')
    Items
@endsection

@section('headername')
    <a href="{{ url('create_item') }}" style="float: right" class="btn btn-lg btn-primary">+ Add Item</a>
    Items
@endsection

@section('content')

						
    <!-- Feed Activity -->
    <div class="card  card-table flex-fill">
        <div class="card-header">
            
            <h4 class="card-title"> + Items List</h4>
        </div>
        <br>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="mytable" style="width: 100%">
                    <thead>
                        <tr>		
                            <th>Item Image</th>											
                            <th>Item Code</th>
                            <th>Name</th>
                            <th>Item Number</th>
                            <th>Price</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Note</th>
                            <th>Platinum Percentage</th>
                            <th>Pladium Percentage</th>
                            <th>Rhodium Percentage</th>
                            <th>Action</th>
                            {{-- <th>Actions</th>										 --}}
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
            "url": "{{ route('itemdata.getdata') }}",
            "type": "GET"
        },
       
        "columns":[
            { data: 'item_image', name: 'item_image',
                    render: function( data, type, full, meta ) {
                        return "<img src=\"/" + data + "\" height=\"50\"/>";
                    }
                },
            { "data": "item_code" },
            {"data": "item_name" },
            { "data": "item_numbers" },
            { "data": "price" },
            { "data": "item_make"},
            { "data": "item_model" },
            { "data": "item_year" },
            { "data": "item_note" },
            { "data": "platinum_percentage" },
            { "data": "pladium_percentage" },
            { "data": "rhodium_percentage" },
            {data: 'action', name: 'action', orderable: false, searchable: false}
          
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
    
$('#mytable').on('click', '.btn-delete[data-remote]', function (e) { 
    alert("press");
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = $(this).data('remote');
    // confirm then
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        data: {method: '_DELETE', submit: true}
    }).always(function (data) {
        $('#mytable').DataTable().draw(false);
    });
 
});
});
           
    
    </script>
@endsection