{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')
<style>
    .error{
        color: red;
    }
</style>
@section('title', '| Add User')

@section('content')

<div class='col-lg-12 col-lg-offset-4'>
    <h1><i class='fa fa-user-plus'></i> Add User</h1>
    <hr>

   <div style="margin-left: 20%">
    {{ Form::open(array('url' => 'users','id'=>'registration')) }}

    <div class="row">
        <div class="form-group col-3">
            {{ Form::label('firstname', 'FirstName') }}
            {{ Form::text('first_name', '', array('class' => 'form-control','required' => '')) }}
        </div>
        <div class="form-group col-3">
            {{ Form::label('lastname', 'LastName') }}
            {{ Form::text('last_name', '', array('class' => 'form-control','required' => '')) }}
        </div>
    </div>
    <div class='form-group'>
            {{ Form::label('roles', 'Roles') }}
            <br>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>
    <div style="margin-left: -1%">
        <div class="form-group col-6">
            {{ Form::label('email', 'Username or Email') }}
            {{ Form::text('email', '', array('class' => 'form-control email','required' => '','id'=> 'email')) }}
        </div>
        <div class="form-group col-6">
            {{ Form::label('address', 'Address') }}
            {{ Form::text('address', '', array('class' => 'form-control','required' => '')) }}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-3">
            {{ Form::label('city', 'City') }}
            {{ Form::text('city_name', '', array('class' => 'form-control','required' => '')) }}
        </div>
        <div class="form-group col-3">
            {{ Form::label('province', 'Province') }}
            {{ Form::text('province', '', array('class' => 'form-control','required' => '')) }}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-3">
            {{ Form::label('postal_code', 'Postal Code') }}
            {{ Form::text('postal_code', '', array('class' => 'form-control','required' => '')) }}
        </div>
        <div class="form-group col-3">
            {{ Form::label('phone_num', 'Phone No') }}<br>
            {{ Form::text('phone_num','' ,array('class' => 'form-control','required' => '')) }}
    
        </div>
    </div>
   

    <div style="margin-left: -1%">
        <div class="form-group col-6">
            {{ Form::label('password', 'Password') }}<br>
            {{ Form::password('password', array('class' => 'form-control','required' => '')) }}
    
        </div>
    
        <div class="form-group col-6">
            {{ Form::label('password', 'Confirm Password') }}<br>
            {{ Form::password('password_confirmation', array('class' => 'form-control','required' => '')) }}
    
        </div>
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
   </div>

</div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" type="text/javascript"></script>

<script>
      var email =  $("#email").val();
    $('#registration').validate({
        rules: {            
            email: {
                required: true,
                remote: {
                    url: "{{url('user/checkemail')}}",
                    type: "post",
                    data: {
                        email:$(email).val(),
                        _token:"{{ csrf_token() }}"
                        },
                    dataFilter: function (data) {
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