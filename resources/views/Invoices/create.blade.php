@extends('layouts.master')
<!------ Include the above in your HEAD tag ---------->

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

        width: 23.8% !important;

        height: auto;

    }

    body {
        -moz-transform: scale(0.8, 0.8) !important;
        /* Moz-browsers */
        zoom: 0.8 !important;
        /* Other non-webkit browsers */
        zoom: 80% !important;
        /* Webkit browsers */
    }

    .slimScrollDiv {
        overflow: visible !important;
    }

    .sidebar-inner {
        overflow: visible !important;
    }

</style>
@section('title')
    Invoice
@endsection
@section('content')

    <div class="card">
        <br><br><br>
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
                                <strong>Generate Invoice Date:</strong><br>
                                {{ date('F j, Y') }}<br><br>
                                <form method="post" enctype="multipart/form-data" action="{{ url('upload_file') }}"
                                    class="form-inline">
                                    @csrf
                                    <input type="text" name="item_ids" id="item_ids" value=" {{ request()->item_id }}"
                                        hidden>
                                    <label for="">File</label>
                                        <input type="file" name="image" id="" required
                                        class="col-xs-3 col-lg-3 col-3 col-md-3" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="">Date</label>&nbsp;&nbsp;&nbsp;
                                        <input type="date" name="date" id=""
                                        class="form-control col-xs-3 col-lg-3 col-3 col-md-3" required >&nbsp;&nbsp;&nbsp;


                                    <button type="submit"
                                        class="btn btn-lg btn-success col-xs-3 col-lg-3 col-3 col-md-3">Save
                                        Invoice</button>


                                </form>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address style="font-size: 15px;">
                                <strong style="font-size: 15px;">Generate By:</strong><br>
                                {{ Auth::user()->first_name }}{{ ' ' }}{{ Auth::user()->last_name }}<br>
                                {{ Auth::user()->phone_num }}<br>
                                {{ Auth::user()->address }}<br>
                                {{ Auth::user()->city_name }}{{ ', ' }}{{ Auth::user()->postal_code }}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address style="font-size: 15px;">
                                {{-- <strong>Generate Invoice Date:</strong><br>
                        {{  date("F j, Y") }}<br><br> --}}
                            </address>
                        </div>
                        <div class="col-lg-2 text-right">
                            <address>

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
                                        {{-- <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>Total</strong></td>
                                            <td class="no-line text-right">$685.99</td>
                                            <td class="no-line text-right">$685.99</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-3">


                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>