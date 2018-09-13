@extends('customer.layout.auth')

@section('service_form')

{{--  check as category and main office is using the same file  --}}
@if(isset($products))
<a href = "{{route('OfficeServices.catgeories')}}">Sort By Category</a>
@else
@if(count($cproducts) > 0)

<?php $products = $cproducts;
?>
@endif
@endif
@if(count($products) > 0)
@foreach($products as $product)
            <div class="well">
                <div class="row">
                   
                    <div class="col-md-8">
                       Name:{{$product->name}}<br>
                      Description:{{$product->description}}<br>
                       Price:   {{$product->price}}
                    </div>
                </div>
                <a href="/customer/order/OfficeServices/{{$product->id}}">Show All Services</a>
  
            </div>
@endforeach
@else
No Product Found
@endif
@endsection