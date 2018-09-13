@extends('customer.layout.auth')

@section('service_form')

@if(count($data) > 0)
@foreach($data as $product)
    <a href= "{{route('catgeory',[$product->id])}}">{{$product->name}}</a>
    <?php
    echo "<br>";
    ?>
@endforeach
@else
No Product Found
@endif
@endsection
