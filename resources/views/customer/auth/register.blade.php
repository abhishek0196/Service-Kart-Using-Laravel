@extends('customer.layout.auth')
@section('content_script')
<script src= "https://cdn.jsdelivr.net/openlocationcode/latest/openlocationcode.min.js"></script>

<script src= "https://cdnjs.cloudflare.com/ajax/libs/openlocationcode/1.0.3/openlocationcode.min.js"></script>

<script>

//x.innerHTML = "Dsfd";

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


<style>

/* tooltip */


.tool-tip{
	color: #fff;
	background-color: rgba( 0, 0, 0, .7);
	text-shadow: none;
	font-size: .8em;
	visibility: hidden;
	-webkit-border-radius: 7px; 
	-moz-border-radius: 7px; 
	-o-border-radius: 7px; 
	border-radius: 7px;	
	text-align: center;	
	opacity: 0;
	z-index: 999;
	
	position: absolute;
	cursor: default;
	-webkit-transition: all 240ms ease-in-out;
	-moz-transition: all 240ms ease-in-out;
	-ms-transition: all 240ms ease-in-out;
	-o-transition: all 240ms ease-in-out;
	transition: all 240ms ease-in-out;	
}

.tool-tip{
	top: auto;
	bottom: 114%;
	left: 50%;		
}


.tool-tip:after{
	position: absolute;
	bottom: -12px;
	left: 50%;
	margin-left: -7px;
	content: ' ';
	height: 0px;
	width: 0px;
	border: 6px solid transparent;
    border-top-color: rgba( 0, 0, 0, .7);	
}

/* default heights, width and margin w/o Javscript */

.tool-tip{
	width: 100%;
	height: 22px;
	margin-left: -43px;
}

/* tool tip position right */

.tool-tip.right{
	top: 50%;
	right: auto;
	left: 106%;
	margin-top: -15px;
	margin-right: auto;	
	margin-left: auto;
}

.tool-tip.right:after{
	left: -5px;
	top: 50%;	
	margin-top: -6px;
	bottom: auto;
	border-top-color: transparent;	
    border-right-color: rgba( 0, 0, 0, .7);	
}

/* tool tip position left */


/* tooltip on focus left and right */

.on-focus .tool-tip.left,
.on-focus .tool-tip.right{
	margin-top: -19px;
}

/* on hover of element containing tooltip default*/

*:not(.on-focus):hover > .tool-tip,
.on-focus input:focus + .tool-tip{
	visibility: visible;
	opacity: 1;
	-webkit-transition: all 240ms ease-in-out;
	-moz-transition: all 240ms ease-in-out;
	-ms-transition: all 240ms ease-in-out;
	-o-transition: all 240ms ease-in-out;
	transition: all 240ms ease-in-out;		
}


/* tool tip slide out */

*:not(.on-focus) > .tool-tip.slideIn,
.on-focus > .tool-tip{
	display: block;
}

.on-focus > .tool-tip.slideIn{
	z-index: -1;
}

.on-focus > input:focus + .tool-tip.slideIn{
	z-index: 1;
}


/* right slideIn */

*:not(.on-focus) > .tool-tip.slideIn.right,
.on-focus > .tool-tip.slideIn.right{
	left: 50%;		
}

*:not(.on-focus):hover > .tool-tip.slideIn.right,
.on-focus > input:focus + .tool-tip.slideIn.right{
	left: 105%;
}

</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST"   >
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                            <div class="on-focus clearfix" style="position: relative; padding: 0px; margin: 10px auto; display: table; float: left">
                                <input id="name"  onblur = "getLocation();" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" >
                                <div class="tool-tip slideIn right">Example: John Doe</div>
		</div>
                                

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">

                                <div class="on-focus clearfix" style="position: relative; padding: 0px; margin: 10px auto; display: table; float: left">
                                 <input id="email" pattern  = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <div class="tool-tip slideIn right">Example: example@xyz.com</div>
        </div>

                               

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <div class="on-focus clearfix" style="position: relative; padding: 0px; margin: 10px auto; display: table; float: left">
                                <input id="phone_no" type="tel" pattern="[6789][0-9]{9}" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" name="phone_no" value="{{ old('phone_no') }}" required title= "Enter The Phone Number">
                                <div class="tool-tip slideIn right">Example: 9999999999</div>
        </div>
                               

                                @if ($errors->has('phone_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                 <div class="on-focus clearfix" style="position: relative; padding: 0px; margin: 10px auto; display: table; float: left">
                                 <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <div class="tool-tip slideIn right">Minimum 6 characters required </div>
        </div>
                              

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                       
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <div class="on-focus clearfix" style="position: relative; padding: 0px; margin: 10px auto; display: table; float: left">
                                 <input id="password-confirm" type="password"  class="form-control" name="password_confirmation" required>
                                <div class="tool-tip slideIn right">Should be same as the  Above Password</div>
        </div>
                               
                            </div>
                        </div>
                    
                                <input id="google_code" type="hidden" class="form-control{{ $errors->has('google_code') ? ' is-invalid' : '' }}" name="google_code"  value="{{ old('google_code') }}" >

                                @if ($errors->has('google_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('google_code') }}</strong>
                                    </span>
                                @endif
                            <p id = "demo"></p>
                            <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection