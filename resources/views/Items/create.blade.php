{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')
<style>
    .error {
        color: red;
    }
    .required label:after {
    color: #e32;
    content: ' *';
    display:inline;
    font-size: 20px;
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
        <a href="{{ url('itemdata') }}" class="btn btn-success" style="float: right">Back</a>
        <h1><i class='fa fa-plus'></i> Add Item</h1>
        <hr>



        <div class="row">
            <div class="col-lg-6 col-md-6 col-6">
               
            </div>
            <br>
            <div class="col-lg-12 col-md-6 col-xs-6 col-6">
               <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data" id="bulk_form" class="form-inline" style="margin-left:20%;">
                    @csrf
                    
                    <h4>Bulk File Upload:</h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="file" required>
                            {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                       
                    <button class="btn btn-info">Import data</button>&nbsp;&nbsp;
                    <a href="{{ asset('upload/sample_file.xlsx') }}" class="btn btn-success" target="_blank">Sample File</a>

                    {{-- <a class="btn btn-success" href="{{ route('file-export') }}">Export data</a> --}}
                </form>
            </div>
        </div>
        <hr>
        <br><br>
        <div style="margin-left: 20%">
                <form action="{{ url('item_insert') }}" method="post"  enctype="multipart/form-data">
                    @csrf
            <div class="row required">
                <div class="form-group col-3">
                    {{ Form::label('code', 'Item code') }}
                    {{ Form::text('code', '', ['class' => 'form-control item_code', 'required' => '','placeholder'=>'Enter item code']) }}
                    <p class="error"></p>
                </div>
                <div class="form-group col-3">
                    {{ Form::label('name', 'Item name') }}
                    {{ Form::text('name', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item name']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('number', 'Item number') }}
                    {{ Form::text('number', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item number']) }}
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
            <div class="row required">
               
                <div class="form-group col-3">
                    {{ Form::label('make', 'Item make') }}
                    {{ Form::text('make', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item make']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('model', 'Item model') }}
                    {{ Form::text('model', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item model']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('year', 'Year') }}
                    {{ Form::text('year', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item year']) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6 required">
                    {{ Form::label('price', 'Price($)') }}
                    {{ Form::text('price', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item price']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('img', 'Image') }}
                    <input type="file" name="image[]" id="" multiple="multiple" >
                </div>
            </div>
            <div class="row required">
                <div class="form-group col-3">
                    {{ Form::label('platinum', 'Platinum %') }}
                    {{ Form::text('platinum_percentage', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter platinum percentage']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('pladium', 'Pladium %') }}
                    {{ Form::text('pladium_percentage', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter pladium percentage']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('rhodium', 'Rhodium %') }}
                    {{ Form::text('rhodium_percentage', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter rhodium percentage']) }}
                </div>
            </div>
            <div class="row required">
                <div class="form-group col-9">
                    {{ Form::label('note', 'Note') }}
                    {{ Form::textArea('note', '', ['class' => 'form-control', 'required' => '','placeholder'=>'Enter description','rows' => 5, 'cols' => 40]) }}
                </div>

            </div>


                <div style="float: right;margin-right:25%">
                    {{ Form::submit('Save Item', ['class' => 'btn btn-info']) }}
                    </div>

            {{ Form::close() }}
            <br><br> <br><br>
            {{-- <button type="button" class="btn btn-success" style="margin-left:7%;margin-top:-4.1%;" id="bulk_file">Bulk File</button> --}}
            <div class="col-4 col-lg-4 col-md-4" style="margin-left: 15%;margin-top:-3.8%">
           
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
            $(".item_code").mouseleave(function(){
                    var item_code = $(this).val();
            var url = "{{url('check_item_code')}}";
            $.ajax({
                      
                      url : url,
                      type : 'POST',
                      cache: false,
                      data: {
                          _token:'{{ csrf_token() }}',
                          item_code : item_code,
                          },
                      success:function(data){
                        console.log(data);
                        if (data == 1) {
                            $(".error").text("item code already exists!");
                        }
                        console.log("success");
                      
                      }
        });
            });
            
        });
    </script> 
@endsection
