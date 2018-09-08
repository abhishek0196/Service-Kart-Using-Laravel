@extends('customer.layout.auth')


@section('service_form')
@if(count($data) > 0)
@foreach($data as $product)
            <div class="well">
                <div class="row">
                   
                    <div class="col-md-8">
                       Service Name:{{$product->pname}}<br>
                     {{--    Service Price:{{$product->price}}<br>  --}}
                       Service Desription:{{$product->description}}<br>
                      Service Provider Phone Number:{{$product->phone_no}}<br>
                      Service Provider Name:{{$product->name}}<br>

                    <?php 
                    $status = $product->status;
                   
                    ?>
                    
                    @if (!strcmp($status,'pending'))

                        Order status : <div class="btn btn-s btn-warning"> {{$status}}</div>
                    
                    @elseif (!strcmp($status,'approved'))
                    Order status : <div class="btn btn-s btn-success"> {{$status}}</div>
                        
                    @endif
                    
                      
                       
                        
                    </div>
                    {{--  <div class="col-md-4">
                        <a href="{{route('status.approve',[$product->id])}}" class="btn btn-s btn-success" style = "border-radius: 8px;">Approve</a>
                        <a href="{{route('status.reject',[$product->id])}}" class="btn btn-s btn-danger" style = "border-radius: 8px;">Decline</a>
                    </div>  --}}
                </div>
                
  
            </div>
@endforeach
@else
No Product Found
@endif
@endsection
