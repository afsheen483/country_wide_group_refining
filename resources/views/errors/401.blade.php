@extends('errors.minimal')

@section('title', __('Woops! Something went wrong'))
@section('code', '401')
@section('message', __('Woops! Something went wrong'))
@section('error')
    {{ $msg }}
@endsection


