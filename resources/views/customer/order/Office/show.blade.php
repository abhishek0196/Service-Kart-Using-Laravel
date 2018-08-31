@extends('customer.layout.auth')

@section('service_form')

        {!! Form::open(['action' => 'CustomerAuth\Orders\OfficeServiceController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="well">
                <div class="row">
                   
                    <div class="col-md-8">
                       Name:<input  name = "pname" type = "text" value ="{{$product->name}}" readonly><br>
                      Description:<input name = "pdesc" type = "text" value ="{{$product->description}}" readonly><br>
                       Price: <input name = "pprice" type = "text" value ="  {{$product->price}}" readonly>
                       <input name ="psid"  type = "hidden" value = "{{$product->serviceprovider_id}}">
                       <input name ="pid"  type = "hidden" value = "{{$product->id}}">
                    </div>
                </div>
{{Form::submit('Submit', ['class'=>'btn btn-success'])}}
                
  
            </div>
        </form>
@endsection