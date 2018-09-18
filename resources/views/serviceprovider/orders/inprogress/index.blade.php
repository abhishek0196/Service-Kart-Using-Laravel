@extends('serviceprovider.layouts.app')

@section('content')

{{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  --}}

<script src= "https://cdn.jsdelivr.net/openlocationcode/latest/openlocationcode.min.js"></script>

<script src= "https://cdnjs.cloudflare.com/ajax/libs/openlocationcode/1.0.3/openlocationcode.min.js"></script>


@if(count($data) > 0)

@foreach($data as $product)
           
            <div class="well"   >
                <div class="row">
                   
                    <div class="col-md-8">
                       Service Name:{{$product->name}}<br>
                       Service Price:{{$product->price}}<br>
                       Service Desription:{{$product->description}}<br>
                      Customer Email:{{$product->email}}<br>
                      Customer Phone No.:{{$product->phone_no}}<br>
                       <input type = "hidden" id = "gcode" value = "{{$product->gcode}}" name = "gcode" >
                      
                    
                      <div  class ="address"> </div> 
                    </div>
                    <div class="col-md-4">
                    
                        <a href="{{route('status.completed',[$product->id])}}" class="btn btn-s btn-success" style = "border-radius: 8px;">Completed</a>
                        
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
  <script>
    
    var innerLoop = 1;
      var gcode = document.getElementsByName('gcode');
      var address = document.getElementsByClassName('address');
      var count = document.getElementsByClassName('address').length;
    for (var i=0;i<count;i++)
    {
        var gcode = document.getElementsByName('gcode')[i].value ;
        var obj= OpenLocationCode.decode(gcode);
        //alert(obj.longitudeCenter);

        var Httpreq = new XMLHttpRequest(); // a new request
        Httpreq.open("GET","https://nominatim.openstreetmap.org/reverse.php?format=json&lat="+obj.latitudeCenter+"&lon="+obj.longitudeCenter+"&zoom=18",false);
        Httpreq.send(null);
        var result = JSON.parse(Httpreq.responseText);          
        //alert(json_obj.display_name); 
        document.getElementsByClassName('address')[i].innerHTML ="Customer Address: "+ result.display_name;
        
   }
</script>   
@endsection
