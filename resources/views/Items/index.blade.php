@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">  
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> --}}
{{-- <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css"> --}}

@section('title')
    Items
@endsection

@section('headername')

    <a href="{{ url('create_item') }}" style="float: right" class="btn btn-md btn-primary">+ Add Item</a>

    <a href="/metal_price" target="_blank" style="float: right; margin-right:0.1%" class="btn btn-md btn-success">Metal Price</a>
    <div class="container-fluid" >
        <form class="form-inline"  id="inline_form" style="float: right;margin-right:0.1%">
            <label for="" style="font-size: 25px;">Update Price by %</label>&nbsp;&nbsp;
            <input type="number" id="percentage" max="100" min="0" name="percentage" class="form-control col-2" required>&nbsp;&nbsp;

            {{-- <label for="">Pladium</label>&nbsp;&nbsp;
            <input type="text" id="pladium" placeholder="Enter Pladium Percentage...." name="pladium_percentage" class="form-control">&nbsp;&nbsp;
            <label for="">Rhodium</label>&nbsp;&nbsp;
            <input type="text" id="rhodium" placeholder="Enter Rhodium Percentage...." name="rhodium_percentage" class="form-control">&nbsp;&nbsp; --}}
            <button  class="btn btn-success btn-md" id="update_prices">Price update</button>
          </form>
    </div>
    Items
@endsection

@section('content')
    <form action="{{ url('invoice_generate') }}" target="_blank" method="get">
        @csrf
        <input type="text" name="item_id"  id="item_ids" hidden=""> 
        {{-- <input type="text" name="vendor_id"  id="vendor_id" hidden="">  --}}
        <button style="display: none" id="one"  class="btn btn-primary" type="submit">Generate Invoice</button>
    </form>
						
    <!-- Feed Activity -->
    <div class="card  card-table flex-fill">
       
        <div class="card-body">
            <br>
           
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-lg-2 col-sm-2 col-3">
                        <label for=""></label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="All">All User</option>
                            @foreach ($user_array as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name }}{{ " " }}{{ $user->last_name }}</option>
                            @endforeach
                        </select>    
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-2 col-3" style="margin-top: 0.5%">
                            {{-- <button type="button" class="btn btn-md btn-success" id="update_percentage">Percentage</button> --}}
                    </div>
                </div>
            </div>
               <br>
            <div class="table-responsive">
                <table class="table" id="mytable" style="width: 100%">
                    <thead>
                        <tr>		
                            <th><input type="checkbox" name="checkAll" id="selectAll" value=""></th>	
                            <th>ID</th>								
                            <th>Code</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            @hasrole('admin')
                            <th>Price($)</th>
<!--                             <th>Note</th>
 -->                        
                            <th>Platinum <br>
                                Percentage</th>
                                <th>Pladium <br>
                                Percentage</th>
                                <th>Rhodium <br>
                                Percentage</th>
                            @endhasrole
                            <th>Action</th>
                            <th></th>
                         
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
// //   });
// "rowCallback": function( row, data, index ) {
//        var d =  $( row )
//             .attr('data-price');
//             alert(d);
//         if ( {data:"same_col"} > 0 )
//        
//         else
//         {
//             $('td', row).css('background-color', 'Orange');
//         }
//     },


var table =  $('#mytable').DataTable({
        destroy: true,
        "scrollX": true,
        "ordering":false,
        "processing": true,
        "serverSide": true,
        
        "ajax": {
            "url": "{{ route('itemdata.getdata') }}",
            "type": "GET"
        },
       
        "columnDefs": [
        { "class": "item_price" ,"targets": 8, 'createdCell':  function (td, cellData, rowData, row, col) {
        @hasrole('admin')
           $(td).attr('contenteditable', 'true'); 
        @endhasrole
        }
        },    

    ],
        "columns":[
            {data: 'select_items', name: 'select_items', orderable: false, searchable: false},
            { "data": "id" },
            { "data": "item_code" },
            {"data": "item_name" },
            { "data": "item_numbers" },
            { "data": "item_make"},
            { "data": "item_model" },
            { "data": "item_year" },
            @hasrole('admin')
            { "data": "price" },
            // { "data": "item_note" },
            
            { "data": "platinum_percentage","name":"platinum_percentage" },
            { "data": "pladium_percentage" },
            { "data": "rhodium_percentage" },   
            @endhasrole   
            {data: 'action', name: 'action', orderable: false, searchable: false},

             { data:'same_col',name:'same_col',orderable: false, searchable: false,visible:true }   
          
        ],
                
        createdRow: function( row, data, dataIndex ) {
        // Set the data-status attribute, and add a class 
        $( row ).find('td:eq(8)')
            .attr('data-price', data.id );
            
            $( row ).find('td:eq(8)')
            .attr('id',"item_id_"+data.id );
            $( row ).find('td:eq(8)')
            .attr('data-user', data.user_id );
            $( row ).find('td:eq(1)')
            .attr('id',"all_items_id");
            @hasrole('vendor')
            var val = $( row ).find('td:eq(9)').text();
            if (val > 0) {
                $('td', row).css('background-color', '#90EE90');
            }
            @endhasrole
            @hasrole('admin')
            var val = $( row ).find('td:eq(13)').text();
            if (val > 0) {
                $('td', row).css('background-color', '#90EE90');
            }
            @endhasrole
            
    }
});


// function getImg(data, type, full, meta) {
//         var orderType = data.OrderType;
//         //alert(data);
//         if (data > 0)  {
//             table.row( this ).css('background-color', 'Red');
//        } 
//     }

    $('#user_id').on("change",function(){
        var user_id = $(this).val();
    var table =  $('#mytable').DataTable({
        destroy: true,
        "scrollX": true,
        "ordering":false,
        "processing": true,
        "serverSide": true,
        
        "ajax": {
            "url": "{{ route('itemdata.getdata') }}",
            "type": "GET",
            data: {
            _token:'{{ csrf_token() }}',
            user_id : user_id,
            },
        },
       
        "columnDefs": [
           
        { "class": "item_price" ,"targets": 8, 'createdCell':  function (td, cellData, rowData, row, col) {
        @hasrole('admin')
           $(td).attr('contenteditable', 'true'); 
        @endhasrole
           
         
 
        }
        },
        {"class":"item_ids","targets": 1,'createdCell':  function (td, cellData, rowData, row, col) {
            $('td .item_price').attr('id', cellData);
        }},
       
    
        
    ],
   
        "columns":[
            {data: 'select_items', name: 'select_items', orderable: false, searchable: false},
            { "data": "id" },
            { "data": "item_code" },
            {"data": "item_name" },
            { "data": "item_numbers" },
            { "data": "item_make"},
            { "data": "item_model" },
            { "data": "item_year" },
            @hasrole('admin')
            { "data": "price" },
            // { "data": "item_note" },
            { "data": "platinum_percentage","name":"platinum_percentage" },
            { "data": "pladium_percentage" },
            { "data": "rhodium_percentage" },     
            @endhasrole 
            {data: 'action', name: 'action', orderable: false, searchable: false},
            { data:'same_col',name:'same_col',orderable: false, searchable: false,visible:true },

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
    createdRow: function( row, data, dataIndex ) {
        // Set the data-status attribute, and add a class 
        $( row ).find('td:eq(8)')
            .attr('data-price', data.id );
            // alert($( row ).find('td:eq(15)').val());
            $( row ).find('td:eq(8)')
            .attr('id',"item_id_"+data.id );
            $( row ).find('td:eq(8)')
            .attr('data-user', data.user_id );
            $( row ).find('td:eq(1)')
            .attr('data-item-id', data.id );
            $( row ).find('td:eq(1)')
            .attr('id',"all_items_id");
            @hasrole('vendor')
            var val = $( row ).find('td:eq(9)').text();
            if (val > 0) {
                $('td', row).css('background-color', '#90EE90');
            }
            @endhasrole

            @hasrole('admin')
            var val = $( row ).find('td:eq(13)').text();
            if (val > 0) {
                $('td', row).css('background-color', '#90EE90');
            }
            @endhasrole
          
    }
    
    
});
var a = $("#myTable").attr('data-item-id');
console.log("a"+a);
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
           
    
     $('#mytable').on('click', '.delete_btn', function () {
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('item_delete')}}/"+delete_id;
          Swal.fire({
							  title: 'Are you sure?',
							  text: "You won't be able to revert this!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, delete it!'
							}).then(function(result){
                if (result.isConfirmed)  
                  {
                      $.ajax({
                      
                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}'},
                        success:function(data){
                         if (data == 1) {
                          Swal.fire({
                                title:'Deleted!',
                                text:'Your file and data has been deleted.',
                                type: 'success',
                              })
                              th.parents('tr').hide();

                            }
                          else{
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
        $('#mytable').on('click', '.view_btn', function () {
            var view_id = $(this).data("view");
            //alert(view_id);
            // var th=$(this);
            // console.log(delete_id);
            var url = "{{url('view_history')}}";
            $.ajax({
                      
                      url : url,
                      type : 'POST',
                      cache: false,
                      data: {
                          _token:'{{ csrf_token() }}',
                          view_id : view_id,
                          },
                      success:function(data){
                        console.log(data);
                        console.log("success");
                      
                      }
        });
});

//checkboxes
// $('input[type="checkbox"]').click(function ()
//             {
//                 var checkedChbx = $('input[type="checkbox"]:checked');
//                 if (checkedChbx.length > 0)
//                 {
//                     $('#one').show();
//                    console.log(checkedChbx);
//                 }
//              else {
//                 $("#one").hide();
//             }
//             if (checkedChbx.length >= $('input[type="checkbox"]').length)
//                 {
//                     $('#one').show();                    
//                     console.log(length);
//                 }
//                 else
//                 {
//                     $('#all').hide();
//                     $("#one").hide();
//                 }
        
         
//     })
$('#mytable').on('click', '.checkedbox',function() {
    //alert("hi");
  $('#one').toggle( $(".checkedbox:checked").length > 0 );
});
         $("#selectAll").change(function() {
       
        if($(this).is(":checked")) {
           $(".checkedbox").prop('checked', true);
           $('#one').show();
        }
        else {
            $(".checkedbox").prop('checked', false);
            $("#one").hide();
        }
    });



    // now i am getting the id's of this checkboxes
    $('#selectAll').click(function(e){
          
          var item_ids = "";
       
            // patient_ids = patient_ids + 
            if($(this).prop("checked") == true){
                var all_item_ids = $("#all_items_id").text();
                 console.log(all_item_ids);
                 $("#item_ids").val(all_item_ids);
                 
                 $("#vendor").val(all_item_ids);
                //    $("#total_price").html('Total Price:'+all_order_price);
                   
                //     var freight_val = $(this).attr("data-freight");

                //     $("#freight_cost").val(cost);
                //    var total_amount = parseFloat(freight_val) + parseFloat(all_order_price);
                //    $("#total_Amount").html('Total Amount:'+total_amount);

           }else{

                 $("#item_ids").val('');
                 
                   
                   
               
           }

             // console.log(this.data());
         

         
       
          });


          $('#mytable').on('click', '.checkedbox',function(){
             // var val = [];
             // $('[type="checkbox"]:checked')
        //       .each(function(i){
        //         val[i] = $(this).val();
        // });

          if($(this).prop("checked") == true){
                var id = $(this).val();
               // console.log(id);.
                var ids = $("#item_ids").val();
                ids = ids + id + ",";
                console.log(ids);
                $("#item_ids").val(ids);    
                let user_id = $('#user_id :selected').val();
                $("#vendor_id").val(user_id);
          }else{
             var id = $(this).val();
            var ids = $("#item_ids").val();
            ids = ids.replace(id + "," , "");
            console.log(ids);
            $("#item_ids").val(ids);
              
          }
        });  

//     $(".checkedbox").change(function() {
       
//        if($(this).is(":checked")) {
//           $(".checkedbox").prop('checked', true);
//           $('#one').show();
//        }
//        else {
//            $(".checkedbox").prop('checked', false);
//            $("#one").hide();
//        }
//    });


    // $('button').on('click', function() {
    //         var array = [];
    //         $(".checkedbox :checked").each(function() {
    //             array.push($(this).val());
    //         });
    //         console.log(array);
    //         $('#in_id').val(array);
    //     });


        $('#mytable').on('focusout', '.item_price', function (){
            var item_ids = $(this).data("price");
            var val = $("#item_id_"+item_ids).text();
           // alert(val);
            var user_price_value = $.trim(val);
           // alert(price_val);
            var user_id = $(this).data("user");
            //alert(id);
            var url = "{{url('insert_price')}}";
            $.ajax({
                      
                      url : url,
                      type : 'PUT',
                      cache: false,
                      data: {
                          _token:'{{ csrf_token() }}',
                          user_price_value: user_price_value,
                          item_ids : item_ids,
                          user_id : user_id
                          },
                      success:function(data){
                        console.log(data);
                        if (data == 1) {
                            Swal.fire({
                                title:'Congratulations!',
                                text:'Price has updated successfully',
                                type: 'success',
                              })
                        }else{
                            Swal.fire({
                                title:'OOPSS!',
                                text:'Something went wrong',
                                type: 'warning',
                              })
                        }
                      
                      }
        });
        });
        // toggle form
        // $("#update_percentage").click(function(){
        //     $("#inline_form").toggle();
        // });

        // on submit the form
        $("#inline_form").on("submit",function(e){
            e.preventDefault();
            let percentage = $('#percentage').val();
            // let pladium_percentage = $('#pladium').val();
            // let rhodium_percentage = $('#rhodium').val();
            let user_id = $('#user_id :selected').val();

            $.ajax({
                url: "{{ url('update_useritem_prices') }}",
                type:"PUT",
                cache: false,
                data:{
                    "_token": "{{ csrf_token() }}",
                    percentage:percentage,
                    user_id:user_id,
                },
                success:function(data){
                    if (data == 1) {
                        Swal.fire({
                                title:'Congratulations!',
                                text:'Percentage has been added successfully',
                                type: 'success',
                              })
                    }else{
                        Swal.fire({
                                title:'OOPSS!',
                                text:'Something went wrong',
                                type: 'warning',
                              })
                    }
                },
         });
        });
});
           
    
    </script>
@endsection