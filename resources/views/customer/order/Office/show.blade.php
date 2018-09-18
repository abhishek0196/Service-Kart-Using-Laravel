@extends('customer.layout.auth')

@section('service_form')

<script src= "https://cdn.jsdelivr.net/openlocationcode/latest/openlocationcode.min.js"></script>

<script src= "https://cdnjs.cloudflare.com/ajax/libs/openlocationcode/1.0.3/openlocationcode.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&region=in" type="text/javascript"></script>
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                	var codee = OpenLocationCode.encode(latitude,longitude,OpenLocationCode.CODE_PRECISION_EXTRA);
                    
	            document.getElementById("google_code").value=codee;
            });
        });
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
                       Location: <input type="text" id="txtPlaces"  size="40" placeholder="Enter a location" /><br>
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