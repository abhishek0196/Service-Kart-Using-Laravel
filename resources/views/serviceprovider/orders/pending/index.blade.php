@extends('serviceprovider.layouts.app')

@section('content')
@if(count($data) > 0)
@foreach($data as $product)
            <div class="well">
                <div class="row">
                   
                    <div class="col-md-8">
                       Service Name:{{$product->name}}<br>
                       Service Price:{{$product->price}}<br>
                       Service Desription:{{$product->description}}<br>
                      Customer Email:{{$product->email}}<br>
                      Customer Phone No.:{{$product->phone_no}}<br>
                       
                       {{--  https://nominatim.openstreetmap.org/reverse.php?format=json&lat=12.92568750000001&lon=77.6085625&zoom=18  --}}
                        
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('status.approve',[$product->id])}}" class="btn btn-s btn-success" style = "border-radius: 8px;">Approve</a>
                        <a href="{{route('status.reject',[$product->id])}}" class="btn btn-s btn-danger" style = "border-radius: 8px;">Decline</a>
                    </div>
                </div>
                
  
            </div>
@endforeach
<div>
{{ $data->links() }}
</div>
@else
No Product Found
@endif
@endsection
