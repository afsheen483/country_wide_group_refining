{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.master')
<style>
    .error {
        color: red;
    }

</style>
@section('title', 'Edit Item')

@section('content')

    <div class='col-lg-12 col-lg-offset-2'>
        <a href="{{ url('itemdata') }}" class="btn btn-primary btn-lg" style="float: right">Back</a>

        <h1><i class='fa fa-pencil'></i> Edit {{$item->item_name}}</h1>
        <hr>
    
    <div style="margin-left: 20%">
        <form action="{{ url('item_update',['id' => $item->id]) }}" method="post">
            @csrf
            @method('PUT')
       
            <div class="row">
                <div class="form-group col-3">
                    {{ Form::label('code', 'ITEM CODE') }}
                    {{ Form::text('code',$item->item_code, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Code....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name',$item->item_name, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter name....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('number', 'NUMBERS') }}
                    {{ Form::text('number',$item->item_numbers, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Number.... ']) }}
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
                    {{ Form::text('make',$item->item_make, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Make....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('model', 'MODEL') }}
                    {{ Form::text('model',$item->item_model, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Model']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('year', 'YEAR') }}
                    {{ Form::text('year',$item->item_year, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter year....']) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    {{ Form::label('price', 'Price') }}
                    {{ Form::text('price',$item->price, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Price.....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('img', 'Image') }}
                    <input type="file" name="image" id="" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-3">
                    {{ Form::label('platinum', 'Platinum %') }}
                    {{ Form::text('platinum_percentage',$item->platinum_percentage, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Platinum Percentage.....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('pladium', 'Pladium %') }}
                    {{ Form::text('pladium_percentage',$item->pladium_percentage, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Pladium Percentage.....']) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('rhodium', 'Rhodium %') }}
                    {{ Form::text('rhodium_percentage',$item->rhodium_percentage, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Rhodium Percentage.....']) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-9">
                    {{ Form::label('note', 'NOTE') }}
                    {{ Form::textArea('note',$item->item_note, ['class' => 'form-control', 'required' => '','placeholder'=>'Enter Description.....']) }}
                </div>

            </div>



            {{ Form::submit('Add Item', ['class' => 'btn btn-primary']) }}

        </form>
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
    </script>
@endsection
