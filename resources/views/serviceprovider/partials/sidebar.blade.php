@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/serviceprovider/home') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>
              <li >
                <a href="{{ route('profile.index') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Edit Profile</span>
                </a>
            </li>


                            
            
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>@lang('quickadmin.service-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    
                    <li>
                        <a href="{{ route('product_categories.index') }}">
                            <i class="fa fa-folder"></i>
                            <span>@lang('quickadmin.product-categories.title')</span>
                        </a>
                    </li>
                    
                   
                    <li>
                        <a href="{{ route('product_tags.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('quickadmin.product-tags.title')</span>
                        </a>
                    </li>
                    
                   
                    <li>
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>@lang('quickadmin.products.title')</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Orders History</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    
                    <li>
                        <a href="{{ route('completed_orders.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>All Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pending_orders.index') }}">
                            <i class="fa fa-folder"></i>
                            <span>Pending Orders</span>
                        </a>
                    </li>
                    
                   
                    <li>
                        <a href="{{ route('approved_orders.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>Approved Orders</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('inprogress_orders.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>Inprogress Orders</span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

