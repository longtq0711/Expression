@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <resto-group :restaurants="{{ json_encode($restos) }}"></resto-group>
        </div>
    </div>
</div>
@endsection