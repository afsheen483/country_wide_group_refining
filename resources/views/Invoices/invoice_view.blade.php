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
    body {
       
        zoom: 80% !important;
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
                <div class="row">
                    <div class="col-md-9" style="float: left">
                        <br>
                        @if ($items[0]->created_by == '' || $items[0]->created_by == NULL)
                            <h3 style="font-size: 50px">{{ Auth::user()->first_name }}{{ " " }}{{ Auth::user()->last_name }}</h3>
                            <h3> {{ Auth::user()->phone_num }}</h3>
                            <h3>{{ Auth::user()->address }}</h3>
                            <h3>{{ Auth::user()->city_name }}{{ ", " }}{{ Auth::user()->postal_code }}</h3>
                        @else
                           @php
                           
                               $data = \App\Models\User::where('id','=',$items[0]->created_by)->get();
                          
                         echo   "<h3  style='font-size: 40px'>".$data[0]->first_name . " " . $data[0]->last_name."</h3>";
                          echo "<h3>" .$data[0]->phone_num."</h3>";
                           echo "<h3>".$data[0]->address ."</h3>";
                           echo "<h3>". $data[0]->city_name.", " . $data[0]->postal_code."</h3>";
                            @endphp
                        @endif
                        <br>
                        <h2 style="color:#094479"><strong>Bill To</strong></h2>
                        <h3>Country Wide Group Refining</h3>
                        <br>
                        <h2  style="color:#094479"><strong>Invoice Date</strong></h2>
                        <h3>{{ is_null($items[0]->invoice_date) ? date('Y-d-m'): $items[0]->invoice_date  }}</h3>
                    </div>

                    <div class="col-md-3" style="float:right;">
                        <br>
                        <h2  style="font-size: 40px;color:#094479">INVOICE</h2>
                        <h2># {{ rand(1,9999) }}</h2>
                            <br>
                        <form method="post" enctype="multipart/form-data" action="{{ url('upload_file') }}">
                        @csrf
                        <input type="text" name="item_ids" id="item_ids" value=" {{ request()->item_id }}"
                            hidden>
                            <div class="form-group" >
                                {{-- <h3><label for="">File</label> --}}
                               <a href="{{ url('/'.$items[0]->invoice_file) }}" style="font-size: 15px" class="btn btn-lg btn-info" target="blank">Invoice File</a>
                            </div>
                        


                    </form>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-xs-6">
                        <address style="font-size: 15px;">
                            {{-- <strong>Generate Invoice Date:</strong><br>
                    {{  date("F j, Y") }}<br><br> --}}
                        </address>
                    </div>
                    <div class="col-lg-12 text-right">
                        

                            <div style="float: right;">
                               
                           
                    </div>
                       
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
                                        <td><strong>Item Name</strong></td>
                                        <td class="text-center"><strong>Item Code</strong></td>
                                        <td class="text-center"><strong>Item Model</strong></td>
                                        <td class="text-center"><strong>Item Make</strong></td>
                                        <td class="text-center"><strong>Item Number</strong></td>
                                        <td class="text-center"><strong>Price($)</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item->item_name }}</td>
                                            <td class="text-center">{{ $item->item_code }}</td>
                                            <td class="text-center">{{ $item->item_model }}</td>
                                            <td class="text-center">{{ $item->item_make }}</td>
                                            <td class="text-center">{{ $item->item_numbers }}</td>
                                            <td class="text-center p">{{ $item->price }}</td>
                                            {{-- <td class="text-right">$10.99</td> --}}
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
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
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
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
                <div class="m-signature-pad--body" class="col-lg-7 col-md-7 col-xs-12">
                  <canvas style="border: 2px dashed #ccc;height:200px" ></canvas>
                  <textarea class="form-control" name="signature" id="signature" rows="3" hidden></textarea>
                 
                </div>
                    <br>
                  <div class="col-lg-5 col-md-5 col-xs-12" style="float: left;">
                    <button type="button" class="btn btn-lg btn-secondary" data-action="clear">Clear</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-lg btn-success " data-action="save" id="save" >Save</button>
                </div>
                
            </div>
           
              
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-lg-4 col-sm-3 col-6">
                    </div>
                </div>
            </div>
            <br>
          </form>
      

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