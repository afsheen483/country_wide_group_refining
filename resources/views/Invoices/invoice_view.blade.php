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
    margin: 8px 0 8px !important;
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
<a href="{{ url('invoice_slip',['id' => request()->id]) }}"   class="btn btn-info btn-lg" style="float: right;margin-right:0.4%;padding:0.6%"><i class="fa fa-print" ></i></a>&nbsp;&nbsp;

    {{-- Invoice --}}
@endsection
@section('content')

<div class="card">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <br>
                    <h2>Invoice</h2><h3 class="pull-right"> # {{ rand(1,9999) }}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            @php   
                            $data = \App\Models\User::where('id','=',$items[0]->created_by)->get();
                            @endphp
                       <h1> <strong>{{ $data[0]->first_name . " " . $data[0]->last_name }}</strong></h1><br>
                            <h3>{{ $data[0]->phone_num }}<br>
                            {{ $data[0]->address }}<br>
                            {{ $data[0]->city_name.", " . $data[0]->postal_code }}<br></h3>
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <h3><strong>Billed To:</strong></h3>
                                <h3>Country Wide Group Refining</h3><br>
                            </address>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <address>
                            <h3><strong>Invoice Date:</strong></h3>
                            <h3>{{ is_null($items[0]->invoice_date) ? date("F j, Y"): date("jS F, Y", strtotime($items[0]->invoice_date))  }}</h3>
                        </address>
                    </div>
                </div>
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
                                        {{-- <td class="text-center"><strong>Item Code</strong></td>
                                        <td class="text-center"><strong>Item Model</strong></td>
                                        <td class="text-center"><strong>Item Make</strong></td>
                                        <td class="text-center"><strong>Item Number</strong></td> --}}
                                        <td class="text-center"><strong>Price($)</strong></td>
                                        <td class="text-center"><strong>Total</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item->item_code }} {{ "_" }} {{ $item->item_name }} {{ "(" }}{{ $item->item_numbers }}{{ ")" }}</td>

                                            <td class="text-center p">{{ $item->price }}</td>
    								{{-- <td class="text-center">1</td> --}}
    								        <td class="text-center tp">{{ $item->price }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        {{-- <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td> --}}
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
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
                                        {{-- <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td> --}}
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
        @if ($item->vendor_signature == Null)
        <form method="post" enctype="multipart/form-data" action="{{ url('save_signature') }}" >
            @csrf
            @method('PUT')
            <input type="text" name="invoice_head_id" id="invoice_head_id" value=" {{ request()->id }}" hidden>
    
            <div id="signature-pad" class="m-signature-pad">
                <div class="m-signature-pad--body" class="col-lg-7 col-md-7 col-xs-12">
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
        @else
            
        <div class="col-sm-12 col-lg-12 col-md-12" style="margin-left:80%">
                            
            <p style="font-size: 15px;"><b>Vendor Signature</b></p><img src="{{ url('/'.$item->vendor_signature) }}" alt="" height="100px" width="200px">
        </div>
        @endif
       
        
        <div class="col-12" style="text-align: center;">
            
            <p style="font-weight: bold;font-size:14px">Thank you for your business!</p>
        </div>
      

    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script>
        $(document).ready(function(){
            var sum = 0;
            $(".p").each(function(){
                var val = $(this).text();
                console.log(val);
                sum += Number(val);
            });
            console.log(sum);
            $(".price").text("$"+sum.toFixed(2));

            var sum2 = 0;
            $(".tp").each(function(){
                var val2 = $(this).text();
                console.log(val2);
                sum2+= Number(val2);
            });
            console.log(sum2);
            $(".total_price").text("$"+sum2.toFixed(2));
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
      function getZoom(el) {
        
  if (!el || el===document) {
    return 1;
  }
  var z=+$(el).css('zoom');
  if (!z) {
    return 1;
  }
  z*=getZoom(el.parentNode);
  return z;
}
canvas = wrapper.querySelector("canvas");
var zoom=getZoom(canvas[0]);
newX/=zoom;
newY/=zoom;
// }
    </script>
@endsection