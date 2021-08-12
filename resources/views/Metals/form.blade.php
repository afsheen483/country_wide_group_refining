{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', 'Metal Prices')

@section('content')

    <div class='col-lg-12 col-lg-offset-4'>
        <p>Error: @if (isset($msg))
                {{ $msg }}{{ 'There is an error' }}
            @else
                {{ 'No error' }}
            @endif
        </p>
        {{-- <a href="{{ url('itemdata') }}" class="btn btn-primary btn-lg" style="float: right">Back</a> --}}
        <h1><i class='fa fa-plus'></i> Add Metal Prices</h1>
        <hr>

        <div style="margin-left: 20%;margin-top:5%" >
          <form action="{{ url('metal_price') }}" method="POST">
            @csrf
                <div class="form-group col-3">
                    <label for="">Metals</label>
                    <select name="metal_id" id="" required class="form-control">
                        <option value="">Select</option>
                        @foreach ($metal_array as $metal)
                            <option value="{{ $metal->id }}">{{ $metal->metal_name }}</option>
                        @endforeach
                    </select>
                </div>
            <div class="form-group col-3">
                <label for="">Metal Price</label>
                <input type="text" name="price" id="" class="form-control" placeholder="Enter Price..." required>
             </div>
             <div style="margin-left: 1%">
                 <button type="submit" class="btn btn-primary">Add Price</button>
             </div>
            </form>
        </div>

    </div>
 
@endsection
@section('scripts')
   
@endsection
