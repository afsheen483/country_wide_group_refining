{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.master')
   
@section('title', 'View Item')

@section('content')
{{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
<link rel="stylesheet" href="{{ asset('assets/css/show.css') }}">
<!------ Include the above in your HEAD tag ---------->

	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></div>
						  <div class="tab-pane" id="pic-2"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></div>
						  <div class="tab-pane" id="pic-3"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></div>
						  <div class="tab-pane" id="pic-4"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></div>
						  <div class="tab-pane" id="pic-5"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></div>
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="{{ \Request::root();}}/{{ $item->item_image }}" /></a></li>
						</ul>
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{$item->item_name}}</h3>
						<p class="product-description">{{ $item->item_note }}</p>
						<h5 class="Size">
                           <span class="code"> Code: </span>&nbsp;&nbsp;<span>{{ $item->item_code }}</span>
                            <span class="num"> Number:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $item->item_numbers }}</span>
                        </h5>
                        <h5 class="Size">
                            <span class="code"> Make: </span>&nbsp;&nbsp;<span>{{ $item->item_make }}</span>
                             <span class="num"> Model:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $item->item_model }}</span>
                         </h5>
                        </h5>
                        <h5 class="price">Year: <span>{{ $item->item_year }}</span></h5>
                        <br>
                        <h4 class="price">current price: &nbsp;&nbsp;<span>${{ $item->price }}</span></h4>
						{{-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> --}}
						<br>
                        <h4 class="price">Metal Percentage:</h4>
                        <h5 class="sizes">Platinum:
							<span class="size" data-toggle="tooltip" title="small">{{ $item->platinum_percentage }}%</span>
						</h5>
                        <h5 class="sizes">Pladium:
							<span class="size" data-toggle="tooltip" title="small">{{ $item->pladium_percentage }}%</span>
						</h5>
                        <h5 class="sizes">Rhodium:
							<span class="size" data-toggle="tooltip" title="small">{{ $item->rhodium_percentage }}%</span>
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection
@section('scripts')
    
@endsection
