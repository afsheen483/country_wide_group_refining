<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">
@extends('layouts.master')

@section('title', 'View Item')

@section('content')
  
<div class="card  card-table flex-fill">

    <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <br><br><br><br><br><br><br><br><br>
                        <h2 class="heading-section mb-5">Item Details</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="featured-carousel owl-carousel">
                            <div class="item">
                                <div class="work-wrap d-md-flex">
                                    <div class="img order-md-last" style='background-image: url({{ asset("$item->item_image") }})'></div>
                                        <div class="text text-left text-lg-right p-4 px-xl-5 d-flex align-items-center">
                                        <div class="desc w-100">
                                            <h2 class="mb-4">{{ $item->item_name }} <br> <i class="fa fa-dollar"></i>{{ number_format((float)$item->price, 2, '.', '') }}</h2>
                                            <p class="h5 mb-4">Item Code: {{ $item->item_code }}</p>
                                            <p class="h5 mb-4">Number: {{ $item->item_numbers }}</p>
                                            <p class="h5 mb-4">Model: {{ $item->item_model }}</p>
                                            <p class="h5 mb-4">Make: {{ $item->item_make }}</p>
                                            <div class="row justify-content-end">
                                                <div class="col-xl-8">
                                                    <p></p>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="work-wrap d-md-flex">
                                    <div class="img order-md-last" style='background-image: url({{ asset("$item->item_image") }})'></div>
                                        <div class="text text-left text-lg-right p-4 px-xl-5 d-flex align-items-center">
                                            <div class="desc w-100">
                                                <h2 class="mb-4">{{ $item->item_name }}  <br> Description </h2>
                                                
                                                <div class="row justify-content-end">
                                                    <div class="col-xl-8">
                                                        <p>{{ $item->item_note }}</p>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @hasrole('admin')
                            <div class="item">
                                <div class="work-wrap d-md-flex">
                                    <div class="img order-md-last" style='background-image: url({{ asset("$item->item_image") }})'></div>
                                        <div class="text text-left text-lg-right p-4 px-xl-5 d-flex align-items-center">
                                            <div class="desc w-100">
                                                <h2 class="mb-4">Metal  <br> Percentage</h2>
                                                
                                                <div class="row justify-content-end">
                                                    <div class="col-xl-8">
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <p class="h5 mb-4">
                                                    Platinum % : {{ $item->platinum_percentage }}
                                                </p>
                                                <p class="h5 mb-4">
                                                    Pladium % : {{ $item->pladium_percentage }}
                                                </p>
                                                <p class="h5 mb-4">
                                                    Rhodium % : {{ $item->rhodium_percentage }}
                                                </p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @endhasrole
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
        </div>

   @section('scripts')
   <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
   <script src="{{ asset('assets/js/popper.js') }}"></script>
   <script src="{{ asset('assets/js/bootstrap1.min.js') }}"></script>
   <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
   <script src="{{ asset('assets/js/main.js') }}"></script>
   @endsection