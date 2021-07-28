{{-- \resources\views\errors\401.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class='col-lg-4 col-lg-offset-4'>
        <h1><center><br>
        {{ $exception->getMessage() }}
</center></h1>
    </div>

@endsection