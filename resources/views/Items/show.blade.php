{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.master')
    <style>
        label{
            font-size: 25px;
            font-weight: bold;
        }
        span{
            font-size: 20px;
        }
    </style>
@section('title', 'View Item')

@section('content')

    <div class='col-lg-12 col-lg-offset-2'>
        <a href="{{ url('itemdata') }}" class="btn btn-primary btn-lg" style="float: right">Back</a>

        <h1><i class='fa fa-eye'></i> View {{$item->item_name}}</h1>
        <hr>
    
        <div class="card  card-table flex-fill">
            {{-- <div class="card-header">
                
                <h4 class="card-title">Item</h4>
            </div> --}}
            <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <span style="font-weight: bold;font-size:50px">{{$item->item_name}}</span>
                                <br>
                                <img src="{{ \Request::root();}}/{{ $item->item_image }}" alt="" width="1000px" height="600px">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="">Item Name</label><br>
                                <span>{{ $item->item_name }}</span>
                            </div>
                            <div class="col">
                                <label for="">Item Price</label><br>
                                <span>${{ $item->price }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Item Code </label><br>
                                <span>{{ $item->item_code }}</span>
                            </div>
                            <div class="col">
                                <label for="">Item Number</label><br>
                                <span>{{ $item->item_numbers }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Make </label><br>
                                <span>{{ $item->item_make }}</span>
                            </div>
                            <div class="col">
                                <label for="">Model </label><br>
                                <span>{{ $item->item_model }}</span>
                            </div>
                            <div class="col">
                                <label for="">Year</label><br>
                                <span>{{ $item->item_year }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Platinum Percentage</label><br>
                                <span>{{ $item->platinum_percentage }}</span>
                            </div>
                            <div class="col">
                                <label for="">Pladium Percentage</label><br>
                                <span>{{ $item->pladium_percentage }}</span>
                            </div>
                            <div class="col">
                                <label for="">Rhodium Percenatge</label><br>
                                <span>{{ $item->rhodium_percentage }}</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    
@endsection
