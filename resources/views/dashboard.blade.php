@extends('layout')
@section('content')
    <h1>Dashboard</h1>
    Welcome, {{Auth::user()->name}}
   <a href="{{url('logout')}}">Logout</a>
@stop