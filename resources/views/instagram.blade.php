@extends('layout')

@section('content')
    @foreach($instagrams as $insta)

        <img src="{{$insta->images->low_resolution->url}}">

    @endforeach

@stop