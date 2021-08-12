@extends('layouts.master')

@section('title')
    Invoices List
@endsection
@section('headername')

@endsection
@section('content')
       <!-- Feed Activity -->
    <div class="card  card-table flex-fill">
      <div class="card-header">
          {{-- <form action="{{ url('invoices') }}" target="_blank" method="get">
              @csrf
              <input type="text" name="item_id"  id="item_ids" hidden=""> 
              {{-- <input type="text" name="vendor_id"  id="vendor_id" hidden="">  --}}
              {{-- <button style="display: none" id="one"  class="btn btn-lg btn-primary" type="submit">Generate Invoice</button>
          </form>  --}}
      </div>
      <div class="card-body">
          <br>
         
          <div class="container-fluid">
              {{-- <div class="row">
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
                         
                          <th>Invoice ID</th>
                          <th>Invoice File</th>
                          <th>Invoice Date</th>
                          <th>Status</th>
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

var table =  $('#mytable').DataTable({
        destroy: true,
        "scrollX": true,
        "ordering":false,
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
        "columns":[
           
            // { data: 'item_image', name: 'item_image',
            //         render: function( data, type, full, meta ) {
            //             return "<img src=\"/" + data + "\" height=\"50\"/>";
            //         }
            //     },
            
            // { "data": "id" },
            { "data": "id" },
            { "data": "invoice_file" },
            { "data": "invoice_date" },
            { "data": "status" },
            
          
            {data: 'action', name: 'action', orderable: false, searchable: false}
          
        ],
                
        createdRow: function( row, data, dataIndex ) {
        // Set the data-status attribute, and add a class 
        $( row ).find('td:eq(5)')
            .attr('data-price', data.id );
            $( row ).find('td:eq(5)')
            .attr('id',"item_id_"+data.id );
            $( row ).find('td:eq(5)')
            .attr('data-user', data.user_id );
            $( row ).find('td:eq(1)')
            .attr('id',"all_items_id");
    }
});




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
           
        { "class": "item_price" ,"targets": 5, 'createdCell':  function (td, cellData, rowData, row, col) {
           $(td).attr('contenteditable', 'true'); 
           
         
 
        }
        },
        {"class":"item_ids","targets": 1,'createdCell':  function (td, cellData, rowData, row, col) {
            $('td .item_price').attr('id', cellData);
        }},
       
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
   
        "columns":[
            {data: 'select_items', name: 'select_items', orderable: false, searchable: false},
            { "data": "id" },
            { "data": "item_code" },
            {"data": "item_name" },
            { "data": "item_numbers" },
            { "data": "price" },
            { "data": "item_make"},
            { "data": "item_model" },
            { "data": "item_year" },
            { "data": "item_note" },
            { "data": "platinum_percentage","name":"platinum_percentage" },
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
    createdRow: function( row, data, dataIndex ) {
        // Set the data-status attribute, and add a class 
        $( row ).find('td:eq(5)')
            .attr('data-price', data.id );
            $( row ).find('td:eq(5)')
            .attr('id',"item_id_"+data.id );
            $( row ).find('td:eq(5)')
            .attr('data-user', data.user_id );
            $( row ).find('td:eq(1)')
            .attr('data-item-id', data.id );
            $( row ).find('td:eq(1)')
            .attr('id',"all_items_id");
          
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
                        console.log("success");
                      
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
                    console.log(data);
                },
         });
        });
});
           
    
    </script>
@endsection