<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Multi Auth Guard') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
            <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="/css/style4.css">
            <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
    @yield('content_script')
</head>
<body>
@if(!Auth::guard('serviceprovider')->user()   )

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/serviceprovider/home') }}">
                    {{ config('app.name', 'Laravel Multi Auth Guard') }}: Serviceprovider
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    
                        <li><a href="{{ url('/serviceprovider/login') }}">Login</a></li>
                        <li><a href="{{ url('/serviceprovider/register') }}">Register</a></li>
                
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
   
@else
<?php 
$id = Auth::guard('serviceprovider')->user()->id;
?>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <span>Enlarge</span>
                        </button>
                    </div>
                   
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                    
                          <a href="{{ url('/serviceprovider/home') }}">
                            <i class="glyphicon glyphicon-home"></i>
                           Home
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            About
                        </a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-duplicate"></i>
                            Services
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="{{ url('/serviceprovider/service/create') }}">Add Services</a></li>
                            <li><a href="/serviceprovider/service/{{$id}}">Show All Services</a></li>
                            
                            
                        </ul>
                    </li>
                
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-paperclip"></i>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-send"></i>
                            Contact
                        </a>
                    </li>
                </ul>

            
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid" >

                       

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                
       <li class="dropdown">
                            <a href="#user" class="dropdown-toggle" data-toggle="collapse" role="button" aria-expanded="false">
                                {{ Auth::guard('serviceprovider')->user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu" id = "user">
                                <li>
                                    <a href="{{ url('/serviceprovider/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/serviceprovider/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
          </ul>
                           
                        </div>
                    </div>
                    
                </nav>
                 @yield('service_form') 
            </div>
            
        </div>
        
           
@endif


    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>