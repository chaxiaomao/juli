@extends('home.base')

@section('content')
    <img src="{{ $user->avatar }}">
    <span>{{ $user->username }}</span>
    <span>{{ $user->phone }}</span>
    @endsection