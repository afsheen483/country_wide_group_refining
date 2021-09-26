{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.master')
<style>
    .error{
        color: red;
    }
    .required label:after {
    color: #e32;
    content: ' *';
    display:inline;
    font-size: 20px;
}
h5:after {
    color: #e32;
    content: ' *';
    display:inline;
    font-size: 20px;
}
</style>
@section('title', '| Edit User')

@section('content')

<div class='col-lg-12 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h1>
    <hr>
 <div style="margin-left: 20%">
    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT','id' => 'registration')) }}{{-- Form model binding to automatically populate our fields with user data --}}

    <div class="row required">
        <div class="form-group col-3">
            {{ Form::label('firstname', 'FirstName') }}
            {{ Form::text('first_name',NULL, array('class' => 'form-control','required' => '')) }}
        </div>
        <div class="form-group col-3">
            {{ Form::label('lastname', 'LastName') }}
            {{ Form::text('last_name',NULL, array('class' => 'form-control','required' => '')) }}
        </div>
    </div>
    <h5><b>Give Role</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>
    <div style="margin-left: -1%" class="required">
        <div class="form-group col-6">
            {{ Form::label('email', 'Username or Email') }}
            {{ Form::text('email',NULL, array('class' => 'form-control','required' => '','id'=> 'email')) }}
        </div>
        <div class="form-group col-6">
            {{ Form::label('address', 'Address') }}
            {{ Form::text('address',NULL, array('class' => 'form-control','required' => '')) }}
        </div>
    </div>
    <div class="row required">
        <div class="form-group col-3">
            {{ Form::label('city', 'City') }}
            {{ Form::text('city_name',NULL, array('class' => 'form-control','required' => '')) }}
        </div>
        <div class="form-group col-3">
            {{ Form::label('province', 'Province') }}
            {{ Form::text('province',NULL, array('class' => 'form-control','required' => '')) }}
        </div>
    </div>
    <div class="row required">
        <div class="form-group col-3">
            {{ Form::label('postal_code', 'Postal Code') }}
            {{ Form::text('postal_code',NULL, array('class' => 'form-control','required' => '')) }}
        </div>
        <div class="form-group col-3">
            {{ Form::label('phone_num', 'Phone No') }}<br>
            {{ Form::text('phone_num',NULL ,array('class' => 'form-control','required' => '')) }}
    
        </div>
    </div>
    <div style="margin-left: -1%" class="">
        <div class="form-group  col-6">
            {{ Form::label('password', 'Password') }}<br>
            {{ Form::password('password', array('class' => 'form-control')) }}

        </div>

        <div class="form-group  col-6" >
            {{ Form::label('password', 'Confirm Password') }}<br>
            {{ Form::password('password_confirmation',array('class' => 'form-control')) }}

        </div>
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
 </div>
</div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" type="text/javascript"></script>

{{-- <script>
      var email =  $(".email").val();
      var id = $(".email").attr('id');
      console.log(id);
    $('#registration').validate({
        rules: {            
            email: {
                required: true,
                remote: {
                    url: "{{url('edit/checkemail')}}",
                    type: "post",
                    data: {
                        email:email,
                        id:id,
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
</script> --}}
@endsection