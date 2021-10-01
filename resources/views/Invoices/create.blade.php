@extends('layouts.master')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
    .invoice-title h2,
    .invoice-title h3 {
        display: inline-block;
        font-size: 35px;
    }

    .table>tbody>tr>.no-line {
        border-top: none;
    }

    .table>thead>tr>.no-line {
        border-bottom: none;
    }
    .td {
       font-size: 14px;
    }
    .table>tbody>tr>.thick-line {
        border-top: 2px solid;
    }


    .kbw-signature {
        width: 100%;
        height: 200px;
    }

    canvas {

        width: 40% !important;

        height: auto;

    }
    .page-header {
    padding-bottom: 9px !important;
    margin: 10px 0 10px !important;
    border-bottom: 1px solid #eee !important;
}
.page-title{
    font-size: 30px !important;
}
   
</style>
@section('title')
    Invoice
@endsection
@section('headername')
<a href="{{ url()->previous() }}" class="btn btn-lg btn-success" style="float: right">Back</a>
    {{-- Invoice --}}
@endsection
@section('content')
<div class="card">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <br>
                    <h2>Invoice</h2><h4 class="pull-right" style="font-size: 28px"> # {{ rand(1,9999) }}</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            @php   
                            $data = \App\Models\User::where('id','=',$items[0]->created_by)->get();
                            //dd($data);
                            @endphp
                            @if ($data == NULL || $data == '')
                            <h1> <strong>{{ Auth::user()->first_name . " " . Auth::user()->last_name }}</strong></h1><br>
                            <h4>{{ Auth::user()->phone_num }}<br>
                                {{ Auth::user()->address }}<br>
                                {{ Auth::user()->city_name.", " . Auth::user()->postal_code }}<br></h4>

                            @else
                            <h1> <strong>{{ $data[0]->first_name . " " . $data[0]->last_name }}</strong></h1><br>
                            <h4>{{ $data[0]->phone_num }}<br>
                                {{ $data[0]->address }}<br>
                                {{ $data[0]->city_name.", " . $data[0]->postal_code }}<br></h4>

                            @endif
                            
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <h4><strong>Billed To:</strong></h3>
                                <h3>Country Wide Group Refining</h4><br>
                            </address>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <address>
                            <h3><strong>Invoice Date:</strong></h3>
                            <h4>{{ is_null($items[0]->invoice_date) ? date("F j, Y"): date("jS F, Y", strtotime($items[0]->invoice_date))  }}</h4>
                        </address>
                    </div>
                    <div class="col-sm-6 col-lg-6 col-md-6" style="margin-left:81.8%;margin-top:-11%">
                        <form method="post" enctype="multipart/form-data" action="{{ url('upload_file') }}">
                            @csrf
                            <input type="text" name="item_ids" id="item_ids" value=" {{ request()->item_id }}"
                                hidden>
                                <input type="text" name="item_id[]" id="" value="" class="item_id" hidden>
                                <input type="text" name="qty[]" class="in_qty form-control" value="" hidden>
                                <div class="form-group">
                                    <label for="">File</label>
                                    <input type="file" name="image" id="" required
                                    class="col-4" >
                                </div>
                                <div class="form-group">
                                    
                                        <label for="">Date</label>
                                <input type="date" name="date" id=""
                                class="form-control col-4" required value="{{ date('Y-m-d') }}">
                                    
                                </div>
                                <button type="submit"
                                class="btn btn-lg btn-success" id="save_invoice">Save
                                Invoice</button>
                        </form>
                    </div>
    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Items summary</strong></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <td><strong>Description</strong></td>
                                                <td class="text-center"><strong>Price($)</strong></td>
                                                <td class="text-center"><strong>Quantity</strong></td>
                                                <td class="text-center"><strong>Total</strong></td>
                                                {{-- <td class="text-center"><strong>Item Make</strong></td>
                                                <td class="text-center"><strong>Item Number</strong></td>
                                                <td class="text-center"><strong>Price($)</strong></td> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                            @foreach ($items as $item)
                                                <tr class="td">
                                                    <td>{{ $item->item_code }} {{ "_" }} {{ $item->item_name }} {{ "(" }}{{ $item->item_numbers }}{{ ")" }}</td>
        
                                                    <td class="text-center p" id="price_{{ $item->id }}">{{ $item->price }}</td>
                                                    <td class="text-center qty" contenteditable="true" data-item="{{ $item->id }}" id="qty_{{ $item->id }}">{{ is_null($item->quantity) ? '' : $item[0]->quantity }}</td>
                                                    <td class="text-center tp" id="tp_{{ $item->id }}"></td>
                                                    {{-- <td class="text-right">$10.99</td> --}}
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                {{-- <td class="thick-line"></td> --}}
                                                {{-- <td class="thick-line"></td>
                                        <td class="thick-line"></td> --}}
                                                {{-- <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">$670.99</td>
                                        <td class="text-center">$10.99</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$10.99</td> --}}
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                {{-- <td class="no-line"></td> --}}
                                                {{-- <td class="no-line"></td> --}}
                                                <td class="no-line text-center"><strong>Total</strong></td>
                                                <td class="no-line text-center price"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{ url('save_signature') }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="invoice_head_id" id="invoice_head_id" value=" {{ request()->id }}" hidden>
            
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body" class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                            @if ($agent->isMobile())
                            <canvas style="border: 2px dashed #ccc;height:200px;width:300px !important" ></canvas>
                            <textarea class="form-control" name="signature" id="signature" rows="3" hidden></textarea>
                        @else
                            <canvas style="border: 2px dashed #ccc;height:200px;width:300px !important" ></canvas>
                            <textarea class="form-control" name="signature" id="signature" rows="3" hidden></textarea>
                        @endif
                        </div>
                            <br>
                         @if ($agent->isMobile())
                         <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10" style="margin-left:56%">
                            <button type="button" class="btn btn-lg btn-secondary" data-action="clear">Clear</button>&nbsp;&nbsp;
                            <button type="submit" class="btn btn-lg btn-success " data-action="save" id="save" >Save</button>
                        </div>
                         @else
                         <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10" style="float: right;">
                            <button type="button" class="btn btn-lg btn-secondary" data-action="clear">Clear</button>&nbsp;&nbsp;
                            <button type="submit" class="btn btn-lg btn-success " data-action="save" id="save" >Save</button>
                        </div>
                         @endif
                        
                    </div>
                   
                      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 col-lg-4 col-sm-3 col-6">
                            </div>
                        </div>
                    </div>
                    <br>
                  </form>
                  <div class="col-12" style="text-align: center;margin-top:2%">
            
                    <p style="font-weight: bold;font-size:14px">Thank you for your business!</p>
                </div>
                </div>
            </div>
        </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            var sum = 0;
            // $(".p").each(function(){
            //     var val = $(this).text();
            //     console.log(val);
            //     sum += Number(val);
            // });
            // console.log(sum);
            // $(".price").text("$"+sum.toFixed(2));

            var sum2 = 0;
            // $(".tp").each(function(){
            //     var val2 = $(this).text();
            //     console.log(val2);
            //     sum2+= Number(val2);
            // });
            // console.log(sum2);
            // $(".total_price").text("$"+sum2.toFixed(2));
        });
        $(function () {
      var wrapper = document.getElementById("signature-pad"),
          clearButton = wrapper.querySelector("[data-action=clear]"),
          saveButton = wrapper.querySelector("[data-action=save]"),
          canvas = wrapper.querySelector("canvas"),
          signaturePad;
    
      // Adjust canvas coordinate space taking into account pixel ratio,
      // to make it look crisp on mobile devices.
      // This also causes canvas to be cleared.
      window.resizeCanvas = function () {
        var ratio =  window.devicePixelRatio || 1;
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
      }
    
      resizeCanvas();
    
      signaturePad = new SignaturePad(canvas);
    
      clearButton.addEventListener("click", function(event) {
        signaturePad.clear();
      });
    
        //event.preventDefault();
    $('#save').click(function() {
           var image = $("#invoice_file").val();
           var item_ids = $("#item_ids").val();
           var vendor_id = $("#vendor_id").val();
        if (signaturePad.isEmpty()) {
          alert("Please provide a signature first.");
        } else {
          var dataUrl = signaturePad.toDataURL();
          var image_data = dataUrl.replace(/^data:image\/(png|jpg);base64,/, "");
          var text = $("#signature").text(image_data);
        }
      });
      });
     
// }


        $(document).ready(function(){
            $(".qty").on('focusout',function(){
                var id = $(this).data("item");
                //alert(id);
               var ids =  $(".item_id").val();

               ids = ids + id + ",";
               $(".item_id").val(ids);
                    var qty = $("#qty_"+id).text();
                    
                   var i_q =  $(".in_qty").val();
                    //i_q = i_q + id+"_"+qty + ',';
                    i_q = i_q + qty + ',';
                    //$(".in_qty").val(i_q);

               // alert(qty);
                $(".in_qty").val(i_q);
                //var i_q = $(".in_qty").val();

                
            });

            $('.qty').keyup(function(){
                var mult = 0;
                $(".p,.qty").each(function(){
                var id = $(this).data("item");
               
                var qty = $("#qty_"+id).text();
                var price = $("#price_"+id).text();
                console.log("qty"+qty);
                // var unit_price = $('.p', this).text();
                var total_multiply = (qty * 1) * (price * 1);
                console.log(total_multiply);
                $('#tp_'+id).text(total_multiply.toFixed(2));
                // $('#quant_unit',this).text("$"+total_multiply.toFixed(2));
                // $('#contact_lens_cop',this).text("$"+total_multiply.toFixed(2));

                 mult += total_multiply;
             });
             $(".price").text("$"+mult.toFixed(2))
            });

        });
    </script>
@endsection