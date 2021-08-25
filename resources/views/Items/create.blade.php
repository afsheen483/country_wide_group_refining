{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')
<style>
    .error {
        color: red;
    }

</style>
@section('title', 'Add Item')

@section('content')

   <div class="card">
       <br>
    <div class='col-lg-12 col-lg-offset-4'>
        {{-- <p>Error: @if (isset($msg))
                {{ $msg }}{{ 'There is an error' }}
            @else
                {{ 'No error' }}
            @endif
        </p> --}}
        <a href="{{ url('itemdata') }}" class="btn btn-primary" style="float: right">Back</a>
        <h1><i class='fa fa-plus'></i> Add Item</h1>
        <hr>

        <div style="margin-left: 20%">
            {{ Form::open(['action' => 'ItemController@store', 'method' => 'POST','files'=>'true']) }}

            <div class="row">
                <div class="form-group col-3">
                    {{ Form::label('code', 'ITEM CODE') }}
                    {{ Form::text('code', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Code....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter name....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('number', 'NUMBERS') }}
                    {{ Form::text('number', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Number.... ']) }}
                </div>
            </div>
            {{-- <div class='form-group'>
                {{ Form::label('roles', 'Roles') }}
                <br>
                @foreach ($roles as $role)
                    {{ Form::checkbox('roles[]', $role->id) }}
                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                @endforeach
            </div> --}}
            <div class="row">
               
                <div class="form-group col-3">
                    {{ Form::label('make', 'MAKE') }}
                    {{ Form::text('make', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Make....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('model', 'MODEL') }}
                    {{ Form::text('model', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Model']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('year', 'YEAR') }}
                    {{ Form::text('year', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter year....']) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    {{ Form::label('price', 'Price') }}
                    {{ Form::text('price', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Price.....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('img', 'Image') }}
                    <input type="file" name="image" id="" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-3">
                    {{ Form::label('platinum', 'Platinum %') }}
                    {{ Form::text('platinum_percentage', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Platinum Percentage.....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('pladium', 'Pladium %') }}
                    {{ Form::text('pladium_percentage', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Pladium Percentage.....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('rhodium', 'Rhodium %') }}
                    {{ Form::text('rhodium_percentage', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Rhodium Percentage.....']) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-9">
                    {{ Form::label('note', 'NOTE') }}
                    {{ Form::textArea('note', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Description.....']) }}
                </div>

            </div>



            {{ Form::submit('Add Item', ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
            <button type="button" class="btn btn-success" style="margin-left:7%;margin-top:-4.1%;" id="bulk_file">Bulk File</button>
            <div class="col-4 col-lg-4 col-md-4" style="margin-left: 15%;margin-top:-3.8%">
            <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data" id="bulk_form" class="form-inline" style="display: none">
                @csrf
                
                        <input type="file" name="file" >
                        {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                   
                <button class="btn btn-primary">Import data</button>
                {{-- <a class="btn btn-success" href="{{ route('file-export') }}">Export data</a> --}}
            </form>
            </div>
        </div>

    </div>
   </div>
 
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#bulk_file").click(function(){
                $("#bulk_form").toggle();
            });
        });
    </script> 
@endsection
