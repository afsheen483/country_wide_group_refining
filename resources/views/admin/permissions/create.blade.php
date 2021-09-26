{{-- \resources\views\permissions\create.blade.php --}}
@extends('layouts.master')

@section('title', '| Create Permission')

@section('content')
<style>
    .required label:after {
  color: #e32;
  content: ' *';
  display:inline;
  font-size: 20px;
}
h4:after {
  color: #e32;
  content: ' *';
  display:inline;
  font-size: 20px;
}
</style>

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Add Permission</h1>
    <br>

    {{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group required">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$roles->isEmpty()) 
        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    @endif
    <br>
    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection