@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@section('title')
    Invoices List
@endsection
@section('headername')
    Invoice
@endsection
@section('content')
    <!-- Feed Activity -->
    <div class="card  card-table flex-fill">

        <div class="card-body">
            <br>
            <div class="table-responsive">
                <table class="table" id="mytable" style="width: 100%">
                    <thead>
                        <tr>

                            <th>Invoice ID</th>
                            <th>Vendor Name</th>
                            <th>Invoice File</th>
                            <th>Signature</th>
                            <th>Invoice Date</th>
                            <th>Action</th>

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
    {{-- <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            //     $('#mytable tfoot th').each(function() {
            //     var title = $(this).text();
            //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            //   });

            var table = $('#mytable').DataTable({
                destroy: true,
                "scrollX": true,
                "ordering": false,
                "processing": true,
                "serverSide": true,

                "ajax": {
                    "url": "{{ route('invoice.getData') }}",
                    "type": "GET"
                },

                //     // "columnDefs": [
                //     // { "class": "item_price" ,"targets": 5, 'createdCell':  function (td, cellData, rowData, row, col) {
                //     //    $(td).attr('contenteditable', 'true'); 
                //     // }
                //     },        
                // ],
                "columns": [

                    // { data: 'item_image', name: 'item_image',
                    //         render: function( data, type, full, meta ) {
                    //             return "<img src=\"/" + data + "\" height=\"50\"/>";
                    //         }
                    //     },

                    // { "data": "id" },
                    {
                        "data": "id"
                    },
                    {
                        "data":"vendor_name"
                    },
                    {
                        "data": "invoice_file"
                    },
                   { data: 'vendor_signature', name: 'vendor_signature',
                            render: function( data, type, full, meta ) {
                                return "<img src=\"/" + data + "\" height=\"50\"/>";
                            }
                        },
                    {
                        "data": "invoice_date"
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ],

                createdRow: function(row, data, dataIndex) {
                    // Set the data-status attribute, and add a class 
                    $(row).find('td:eq(5)')
                        .attr('data-price', data.id);
                    $(row).find('td:eq(5)')
                        .attr('id', "item_id_" + data.id);
                    $(row).find('td:eq(5)')
                        .attr('data-user', data.user_id);
                    $(row).find('td:eq(1)')
                        .attr('id', "all_items_id");
                }
            });




            $('#user_id').on("change", function() {
                var user_id = $(this).val();
                var table = $('#mytable').DataTable({
                    destroy: true,
                    "scrollX": true,
                    "ordering": false,
                    "processing": true,
                    "serverSide": true,

                    "ajax": {
                        "url": "{{ route('itemdata.getdata') }}",
                        "type": "GET",
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: user_id,
                        },
                    },

                    "columnDefs": [

                        {
                            "class": "item_price",
                            "targets": 5,
                            'createdCell': function(td, cellData, rowData, row, col) {
                                $(td).attr('contenteditable', 'true');



                            }
                        },
                        {
                            "class": "item_ids",
                            "targets": 1,
                            'createdCell': function(td, cellData, rowData, row, col) {
                                $('td .item_price').attr('id', cellData);
                            }
                        },

                        // {
                        //     'targets': 1,
                        // 		'createdCell':  function (td, cellData, rowData, row, col) {
                        //             //var a = $(td).attr('id', cellData); 
                        //                var a = $("tr td").find('.item_price').css( "background-color", "red" );
                        //               // alert(a);
                        //                //console.log(cellData);
                        //              //  $(td).('#mytable td:eq(6)').data('price', 52);

                        //         }
                        // }   

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

            // The cell that has been clicked will be editable

            // $(".item_price").attr('contenteditable', 'true');


            //  var table = $('#example').DataTable();

            // #myInput is a <input type="text"> element
            // $('input[type="search"]').on( 'keyup', function () {
            //   // var output = table.search( this.value ).draw();
            //    //alert(output);
            //    var count = $(this).val().length;
            //    if (count > 3) {

            //    }
            //   var val = $(this).val();
            //   console.log(val);
            //    console.log(count);
            // //    if (val <) {

            // //    }
            // } );


            $('#mytable').on('click', '.delete_btn', function() {
                var delete_id = $(this).attr("id");
                var th = $(this);
                console.log(delete_id);
                var url = "{{ url('invoice_delete') }}/" + delete_id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({

                            url: url,
                            type: 'PUT',
                            cache: false,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Your file and data has been deleted.',
                                        type: 'success',
                                    })
                                    th.parents('tr').hide();

                                } else {
                                    Swal.fire({
                                        title: 'Oopps!',
                                        text: "something went wrong!",
                                        type: 'warning',
                                    })
                                }
                            }

                        });
                    }
                });

            });

            // viewed history
            $('#mytable').on('click', '.view_btn', function() {
                var view_id = $(this).data("view");
                //alert(view_id);
                // var th=$(this);
                // console.log(delete_id);
                var url = "{{ url('view_history') }}";
                $.ajax({

                    url: url,
                    type: 'POST',
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        view_id: view_id,
                    },
                    success: function(data) {
                        console.log(data);
                        console.log("success");

                    }
                });
            });

        //    invoice_slip'
       

            


            // now i am getting the id's of this checkboxes
           

            $('#mytable').on('click', '.checkedbox', function() {
               
                if ($(this).prop("checked") == true) {
                    var id = $(this).val();
                    // console.log(id);.
                    var ids = $("#item_ids").val();
                    ids = ids + id + ",";
                    console.log(ids);
                    $("#item_ids").val(ids);
                    let user_id = $('#user_id :selected').val();
                    $("#vendor_id").val(user_id);
                } else {
                    var id = $(this).val();
                    var ids = $("#item_ids").val();
                    ids = ids.replace(id + ",", "");
                    console.log(ids);
                    $("#item_ids").val(ids);

                }
            });

         

           
        });
    </script>
@endsection
