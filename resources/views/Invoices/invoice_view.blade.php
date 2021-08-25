<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>


    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
        
        <!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">
        
        <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
        
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    

    <div class="card">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-6 col-6">
                    <div class="invoice-title"><br><br>
                        <h2 style="text-align: center">Invoice</h2>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <address style="font-size: 15px;">
                            <strong style="font-size: 15px;">Generate By:</strong><br>
                                {{ Auth::user()->first_name }}{{ " " }}{{ Auth::user()->last_name }}<br>
                                {{ Auth::user()->phone_num }}<br>
                                {{ Auth::user()->address }}<br>
                                {{ Auth::user()->city_name }}{{ ", " }}{{ Auth::user()->postal_code }}
                            </address>
                        </div>
                        <div class="col-lg-6" >
                            <address  style="font-size: 15px; float: right;">
                                <strong>Generate Invoice Date:</strong><br>
                                {{  date("F j, Y") }}<br><br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address  style="font-size: 15px;">
                                {{-- <strong>Generate Invoice Date:</strong><br>
                                {{  date("F j, Y") }}<br><br> --}}
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address  style="font-size: 15px;">
                                {{-- <div style="float: right;">
                                
                                        <form  method="post" enctype="multipart/form-data" action="{{ url('save_signature') }}" class="form-inline">
                                            @csrf
                                            <input type="text" name="item_ids" id="item_ids" value=" {{ request()->item_id }}" hidden>
                                            <input type="file" name="image">
                                            <button type="submit">Submit</button>
                                        </strong>
                                    
                                </div> --}}
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
                                            <td><strong>Item Name</strong></td>
                                            <td class="text-center"><strong>Item Code</strong></td>
                                            <td class="text-center"><strong>Item Model</strong></td>
                                            <td class="text-center"><strong>Item Make</strong></td>
                                            <td class="text-center"><strong>Item Number</strong></td>
                                            <td class="text-center"><strong>Price</strong></td>
                                            <td class="text-right"><strong>Totals</strong></td>
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
                                            <td class="text-center">${{ $item->price }}</td>
                                            <td class="text-right">${{ $item->price }}</td>
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
                                            <td class="no-line text-right">$685.99</td>
                                            <td class="no-line text-right">$685.99</td>
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
                    <div class="m-signature-pad--body">
                      <canvas style="border: 2px dashed #ccc"></canvas>
                      <textarea class="form-control" name="signature" id="signature" rows="3" hidden></textarea>
                     
                    </div>
                  
                    <div class="m-signature-pad--footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                      <br><br>
                      <div class="col-2 col-lg-3 col-md-3" style="margin-left: -1%">
                        <button type="submit" class="btn btn-md btn-success btn-block" data-action="save" id="save">Save Signatures</button>
                    </div>
                    </div>
                </div>
                  
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-lg-4 col-sm-3 col-3">
                        </div>
                    </div>
                </div>
                <br>
              </form>
        </div>
    </div>


    
</body>


<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
        
<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
{{-- <script src="{{  }}"></script> --}}

<!-- Slimscroll JS -->
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>    
<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>  
<script src="{{ asset('assets/js/chart.morris.js') }}"></script>

<!-- Custom JS -->
<script  src="{{ asset('assets/js/script.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script type="text/javascript">
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
        
        //   $.ajax({
        //     url: "{{ url('/save_signature') }}",
        //     type: 'POST',
        //     cache: false,
        //     data: {
        //         _token:'{{ csrf_token() }}',
        //         image_data : image_data,
        //         image : image,
        //         item_ids : item_ids,
        //         vendor_id : vendor_id
        //         },
        //     success:function(data){
        //         console.log(data);
        //   }
        // });
        }
      });
      });
    // });
    
    
    </script>
    
<script type="text/javascript">
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
    
    //   $.ajax({
    //     url: "{{ url('/save_signature') }}",
    //     type: 'POST',
    //     cache: false,
    //     data: {
    //         _token:'{{ csrf_token() }}',
    //         image_data : image_data,
    //         image : image,
    //         item_ids : item_ids,
    //         vendor_id : vendor_id
    //         },
    //     success:function(data){
    //         console.log(data);
    //   }
    // });
    }
  });
  });
// });


</script>

    
</html>