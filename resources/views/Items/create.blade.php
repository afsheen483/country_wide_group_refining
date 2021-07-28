{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')
<style>
    .error {
        color: red;
    }

</style>
@section('title', 'Add Item')

@section('content')

    <div class='col-lg-12 col-lg-offset-4'>
        <p>Error: @if (isset($msg))
                {{ $msg }}{{ 'There is an error' }}
            @else
                {{ 'No error' }}
            @endif
        </p>
        <a href="{{ url('itemdata') }}" class="btn btn-primary btn-lg" style="float: right">Back</a>
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
        </div>

    </div>
 
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
        type="text/javascript"></script>

    <script>
        var email = $("#email").val();
        $('#registration').validate({
            rules: {
                email: {
                    required: true,
                    remote: {
                        url: "{{ url('user/checkemail') }}",
                        type: "post",
                        data: {
                            email: $(email).val(),
                            _token: "{{ csrf_token() }}"
                        },
                        dataFilter: function(data) {
                            var json = JSON.parse(data);
                            console.log(data);
                            if (json.msg == "true") {
                                return "\"" + "Email address already in use!" + "\"";
                            } else {
                                return 'true';
                            }
                        }
                    }
                }
            },
            messages: {
                email: {
                    required: "Email is required!",
                    remote: "Email address already in use!"
                }
            }
        });
    </script>
@endsection
