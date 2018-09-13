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

                    @elseif (!strcmp($status,'rejected'))
                    Order status : <div class="btn btn-s btn-danger"> {{$status}}</div>

                    
                        
                    @endif
                    
                    <?php
                        date_default_timezone_set('Asia/Kolkata');
                       
                        $order_time = strtotime($product->order_time);

                        $current_time = time();

                        $ss = $current_time - $order_time;

                      
                        echo "<br>";
                        echo " Booked: ";
                        $seconds = $ss%60;
                        $min = floor(($ss%3600)/60);
                        $hour = floor(($ss%86400)/3600);
                        $day = floor(($ss%2592000)/86400);
                        $months = floor($ss/2592000);
                        if($months >0)
                            echo "$months months ";
                        if($day > 0 )
                            echo "$day days ";
                        if($hour > 0 )
                            echo "$hour hours ";
                        if($min > 0)
                            echo "$min minutes ";
                        if ($seconds > 0)
                            echo "$seconds seconds ";
                        echo "ago";

                    ?>
                  
                       
                        
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
