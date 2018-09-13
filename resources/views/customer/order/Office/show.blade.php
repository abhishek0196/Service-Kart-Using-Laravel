@extends('customer.layout.auth')

@section('service_form')

<script src= "https://cdn.jsdelivr.net/openlocationcode/latest/openlocationcode.min.js"></script>

<script src= "https://cdnjs.cloudflare.com/ajax/libs/openlocationcode/1.0.3/openlocationcode.min.js"></script>

<script>

//x.innerHTML = "Dsfd";
getLocation();
function getLocation() {
    
     if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(showPosition, showError);
         
         } else { 
            document.getElementById("demo").innerHTML = "Geolocation is not supported by this browser.";
         
    }
}

function showPosition(position) {
  	var codee = OpenLocationCode.encode(position.coords.latitude,position.coords.longitude,OpenLocationCode.CODE_PRECISION_EXTRA);
	document.getElementById("google_code").value=codee;
   
    
 
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
        document.getElementById("demo").innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
        document.getElementById("demo").innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
        document.getElementById("demo").innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
        document.getElementById("demo").innerHTML = "An unknown error occurred."
            break;
    }
}
</script>

        {!! Form::open(['action' => 'CustomerAuth\Orders\OfficeServiceController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
            <div class="well" >
                <div class="row">
                   
                    <div class="col-md-8">
                      Serivce  Name:<input  name = "pname" type = "text" value ="{{$product->name}}" readonly><br>
                      Serivce Description:<input name = "pdesc" type = "text" value ="{{$product->description}}" readonly><br>
                       Serivce Price: <input name = "pprice" type = "text" value ="  {{$product->price}}" readonly>
                       <input name ="psid"  type = "hidden" value = "{{$product->serviceprovider_id}}">
                       <input name ="pid"  type = "hidden" value = "{{$product->id}}">
                       <br>
                       <b>Service Provider Details</b><br>
                        Name->{{$serviceprovider->name}}<br>
                        Phone Number->{{$serviceprovider->phone_no}}<br>
                        Email->{{$serviceprovider->email}}<br>



                        <input id = "google_code" name = "google_code" type = "hidden" value = "" >

                    </div>
                </div>
            {{Form::submit('Submit', ['class'=>'btn btn-success'])}}
                
  
            </div>
        </form>
@endsection