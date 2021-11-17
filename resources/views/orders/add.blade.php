@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2>Home delivery order for {{$resto->name}}</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(!isset($order))
                <order-group :resto-id="{{$resto->id}}"></order-group>
            @else
                <order-group :resto-id="{{$resto->id}}" :orders="{{ json_encode($order) }}"></order-group>
            @endif
        </div>
    </div>
</div>
@endsection
