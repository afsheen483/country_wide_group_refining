
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
    			@if ($items[0]->created_by == Null)
				<div class="col-xs-6">
    				<address style="font-size: 15px;">
    				<strong style="font-size: 15px;">Generate By:</strong><br>
    					{{ Auth::user()->first_name }}{{ " " }}{{ Auth::user()->last_name }}<br>
    					{{ Auth::user()->phone_num }}<br>
    					{{ Auth::user()->address }}<br>
    					{{ Auth::user()->city_name }}{{ ", " }}{{ Auth::user()->postal_code }}
    				</address>
    			</div>
				@else
				<div class="col-xs-6">
    				<address style="font-size: 15px;">
    				<strong style="font-size: 15px;">Generate By:</strong><br>
					@php
						$data = \App\Models\User::where('id','=',$items[0]->created_by)->get();
						
						echo $data[0]->first_name ." " . $data[0]->last_name ."<br>";
						echo $data[0]->phone_num."<br>";
						echo $data[0]->address."<br>";
						echo $data[0]->city_name .", " . $data[0]->postal_code;
						@endphp
					
    				</address>
    			</div>
				
				@endif
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
						<div style="float: right;">
						
								<form  method="post" enctype="multipart/form-data" action="{{ url('upload_file') }}" class="form-inline">
									@csrf
									<input type="text" name="item_ids" id="item_ids" value=" {{ request()->item_id }}" hidden>
									<input type="file" name="image">
									<button type="submit">Submit</button>
								</strong>
							
						</div>
    				</address>
    			</div>
			</div>
    	</div>
    </div>
    <br>
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
</div>
@endsection
