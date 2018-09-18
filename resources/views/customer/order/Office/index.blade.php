@extends('customer.layout.auth')

@section('service_form')


{{--  check as category and main office is using the same file  --}}
@if(isset($products) && count($products) < 0)
<a href = "{{route('OfficeServices.catgeories')}}">Sort By Category</a>
@else
No product

@if(isset($cproducts) &&count($cproducts) > 0)

<?php $products = $cproducts; ?>
@endif
@endif

@if(isset($products) &&count($products) > 0)
<?php $ldate = date('l');// current day ?>


@foreach($products as $product)
    @foreach($day as $days)
        @if($product->serviceprovider_id == $days->serviceproviders_id && $days->day == $ldate )

            <div class="well">
                <div class="row">
                   <div class="col-md-8">
                       Name:{{$product->name}}<br>
                       Description:{{$product->description}}<br>
                       Price:{{$product->price}}
                       
                    </div>
                </div>
                <a href="/customer/order/OfficeServices/{{$product->id}}">Show All Services</a>
  
            </div>
            @endif
    @endforeach
@endforeach

@else
No Product Found
@endif


@endsection