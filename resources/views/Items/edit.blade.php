{{-- \resources\views\users\edit.blade.php --}}

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
@section('title', 'Edit Item')

@section('content')

   <div class="card">
       <br>
    <div class='col-lg-12 col-lg-offset-2'>
        <a href="{{ url('itemdata') }}" class="btn btn-primary" style="float: right">Back</a>

        <h1><i class='fa fa-pencil'></i> Edit {{$item->item_name}}</h1>
        <hr>
    
    <div style="margin-left: 20%">
        <form action="{{ url('item_update',['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
       
            <div class="row required">
                <div class="form-group col-3">
                    {{ Form::label('code', 'Item code') }}
                    {{ Form::text('code',$item->item_code, ['class' => 'form-control item_code', 'required' => '','placeholder'=>'Enter item code']) }}
                    <p class="error"></p>
                </div>
                <div class="form-group col-3">
                    {{ Form::label('name', 'Item name') }}
                    {{ Form::text('name',$item->item_name, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item name']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('number', 'Item number') }}
                    {{ Form::text('number',$item->item_numbers, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item number']) }}
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
                    {{ Form::text('make',$item->item_make, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item make']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('model', 'Item Model') }}
                    {{ Form::text('model',$item->item_model, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item model']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('year', 'Year') }}
                    {{ Form::text('year',$item->item_year, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item year']) }}
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-6 required">
                    {{ Form::label('price', 'Price($)') }}
                    {{ Form::text('price',$item->price, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter item price']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('img', 'Image') }}
                    <input type="file" name="image" id="">
                </div>
            </div>
            <div class="row required">
                <div class="form-group col-3">
                    {{ Form::label('platinum', 'Platinum %') }}
                    {{ Form::text('platinum_percentage',$item->platinum_percentage, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter platinum percentage']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('pladium', 'Pladium %') }}
                    {{ Form::text('pladium_percentage',$item->pladium_percentage, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter pladium percentage']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('rhodium', 'Rhodium %') }}
                    {{ Form::text('rhodium_percentage',$item->rhodium_percentage, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter rhodium percentage']) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-9">
                    {{ Form::label('note', 'Note') }}
                    {{ Form::textArea('note',$item->item_note, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter description','rows' => 5, 'cols' => 40]) }}
                </div>

            </div>



            {{ Form::submit('Edit Item', ['class' => 'btn btn-primary']) }}

        </form>
        <br><br><br><br>
    </div>

    </div>
   </div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
        type="text/javascript"></script>

    <script>
        // var email = $(".email").val();
        // var id = $(".email").attr('id');
        // console.log(id);
        // $('#registration').validate({
        //     rules: {
        //         email: {
        //             required: true,
        //             remote: {
        //                 url: "{{ url('edit/checkemail') }}",
        //                 type: "post",
        //                 data: {
        //                     email: email,
        //                     id: id,
        //                     _token: "{{ csrf_token() }}"
        //                 },
        //                 dataFilter: function(data) {
        //                     var json = JSON.parse(data);
        //                     console.log(data);
        //                     if (json.msg == "true") {
        //                         return "\"" + "Email address already in use!" + "\"";
        //                     } else {
        //                         return 'true';
        //                     }
        //                 }
        //             }
        //         }
        //     },
        //     messages: {
        //         email: {
        //             required: "Email is required!",
        //             remote: "Email address already in use!"
        //         }
        //     }
        // });
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
    </script>
@endsection
