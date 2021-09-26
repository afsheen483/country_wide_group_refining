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
    <br><br><br>

    <div class="container">
        <div class="card col-12">
            <div class="row">
               
                <div class="col-12">
                    <div class="invoice-title"><br><br>
                        <a href="{{ url()->previous() }}" class="btn  btn-success" style="float: right">Back</a>
                          <h2 style="text-align: left">Signatures</h2>
                      </div>
                    <br>
                    
                    @if (!$agent->isMobile())
            <form method="post" enctype="multipart/form-data" action="{{ url('save_signature') }}">
                @csrf
                @method('PUT')
                <input type="text" name="invoice_head_id" id="invoice_head_id" value=" {{ request()->id }}" hidden>
                <br><br>
                <div id="signature-pad" class="m-signature-pad">
                    <div class="m-signature-pad--body">
                      <canvas style="border: 2px dashed #ccc" class="col-lg-4 col-md-4 col-xs-4 col-4"></canvas>
                      <textarea class="form-control" name="signature" id="signature" rows="3" hidden></textarea>
                     
                    </div>
                  
                    <div class="m-signature-pad--footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                      <br><br>
                      <div class="col-3 col-lg-3 col-md-3" style="margin-left: -1%">
                        <button type="submit" class="btn btn-md btn-success btn-block" data-action="save" id="save">Save Signatures</button>
                    </div>
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
              @endif
                </div>
            </div>
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