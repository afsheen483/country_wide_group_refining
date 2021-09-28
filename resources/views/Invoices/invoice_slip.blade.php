<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
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
body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
  
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
  
}
</style>
<page size="A4">

    <div class="row" style="margin-left:5%;margin-right:5%">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right"># {{ rand(1,9999) }}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
                        @php   
                        $data = \App\Models\User::where('id','=',$items[0]->created_by)->get();
                        @endphp
    				<strong>{{ $data[0]->first_name . " " . $data[0]->last_name }}</strong><br>
    					{{ $data[0]->phone_num }}<br>
    					{{ $data[0]->address }}<br>
    					{{ $data[0]->city_name.", " . $data[0]->postal_code }}<br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
                        <strong>Billed To:</strong><br>
                            Country Wide Group Refining<br>
                        </address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Invoice Date:</strong><br>
                        {{ is_null($items[0]->invoice_date) ? date("F j, Y"): date("jS F, Y", strtotime($items[0]->invoice_date))  }}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				{{-- <address>
    					<strong>Order Date:</strong><br>
    					March 7, 2014<br><br>
    				</address> --}}
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row" style="margin-left:5%;margin-right:5%"> 
    	<div class="col-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Item summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Description</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							{{-- <td class="text-center"><strong>Quantity</strong></td> --}}
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							@foreach ($items as $item)
                                <tr>
    								<td>{{ $item->item_code }} {{ "_" }} {{ $item->item_name }} {{ "(" }}{{ $item->item_numbers }}{{ ")" }}</td>
    								<td class="text-center p">{{ $item->price }}</td>
    								{{-- <td class="text-center">1</td> --}}
    								<td class="text-right tp">{{ $item->price }}</td>
    							</tr>
                                @endforeach
    							{{-- <tr>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$670.99</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$15</td>
    							</tr> --}}
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Total</strong></td>
    								<td class="thick-line text-right price" style="font-weight:bold"></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
               
    		</div>
    	</div>

        <div class="col-12" style="float: right">
                            
            <p><b>Vendor Signature</b></p><img src="{{ url('/'.$item->vendor_signature) }}" alt="" height="100px" width="200px">
        </div>
        
        <div class="col-12" style="text-align: center;margin-top:25%">
            
            <p style="font-weight: bold;font-size:14px">Thank you for your business!</p>
        </div>
    </div>
    
</div>
</page>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
</script>

    
