@extends('serviceprovider.layouts.auth')

@section('content')
{!! Form::open(array('action' => 'ServiceproviderAuth\RegisterController@otpCheck', 'method' => 'post')) !!}


<input type = "text" name = "otp" >
{!!Form::close()!!}
@endsection