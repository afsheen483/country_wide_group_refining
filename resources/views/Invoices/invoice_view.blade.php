
@extends('layouts.master')
<!------ Include the above in your HEAD tag ---------->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
{{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script> --}}
<style>
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
	font-size: 35px;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}


.kbw-signature { width: 100%; height: 200px;}

canvas{

    width: 23.8% !important;

    height: auto;

}
body {
        -moz-transform: scale(0.8, 0.8) !important; /* Moz-browsers */
        zoom: 0.8 !important; /* Other non-webkit browsers */
        zoom: 80% !important; /* Webkit browsers */
    }
    .slimScrollDiv{
        overflow:  visible !important;
    }
    .sidebar-inner{
        overflow:  visible !important;
    }


</style>
@section('title')
	Invoice
@endsection
@section('content')
	<br><br>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address style="font-size: 15px;">
    				<strong style="font-size: 15px;">Generate By:</strong><br>
    					{{ Auth::user()->first_name }}{{ " " }}{{ Auth::user()->last_name }}<br>
    					{{ Auth::user()->phone_num }}<br>
    					{{ Auth::user()->address }}<br>
    					{{ Auth::user()->city_name }}{{ ", " }}{{ Auth::user()->postal_code }}
    				</address>
    			</div>
				<div class="col-xs-6 text-right">
    				<address  style="font-size: 15px;">
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
    <br><br><br>
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
              <div class="col-2 col-lg-3 col-md-3">
                <button type="submit" class="btn btn-sm btn-primary btn-block" data-action="save" id="save">Save</button>
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
@endsection
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

