@extends('home.base')

@section('content')
    "{{ session()->get('user') }}"
    @endsection