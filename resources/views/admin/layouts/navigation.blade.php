<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="{{ url('administrator/dashboard')}}">
                        <span class="block m-t-xs font-bold">{{ config('app.name') }}</span> 
                    </a>
                </div>
                <div class="logo-element">
                    {{ substr(config('app.name'),0,1) }}
                </div>
            </li>
            <li class="{{ isset($menu) && ($menu == 'dashboard')?'active':'' }} ">
                <a href="{{ url('administrator/dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ isset($menu) && ($menu == 'pages')?'active':'' }}">
                <a href="{{ url('administrator/page/list') }}"><i class="fa fa-list"></i> <span class="nav-label">Pages</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ isset($subMenu) && ($subMenu == 'page_add')?'active':'' }}"><a href="{{ url('administrator/page/add') }}">Add</a></li>
                    <li class="{{ isset($subMenu) && ($subMenu == 'page_list')?'active':'' }}"><a href="{{ url('administrator/page/list') }}">List</a></li>
                   
                </ul>
            </li>
            <li class="{{ isset($menu) && ($menu == 'category')?'active':'' }}">
                <a href="{{ url('administrator/category/list') }}"><i class="fa fa-list"></i> <span class="nav-label">Category</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ isset($subMenu) && ($subMenu == 'category_add')?'active':'' }}"><a href="{{ url('administrator/category/add') }}">Add</a></li>
                    <li class="{{ isset($subMenu) && ($subMenu == 'category_list')?'active':'' }}"><a href="{{ url('administrator/category/list') }}">List</a></li>
                   
                </ul>
            </li>
           
            <li class="{{ isset($menu) && ($menu == 'permission_management')?'active':'' }}">
                <a href="{{ url('administrator/permission_management/list') }}"><i class="fa fa-list"></i> <span class="nav-label">Sub Admin</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ isset($subMenu) && ($subMenu == 'permission_management_add')?'active':'' }}"><a href="{{ url('administrator/permission_management/add') }}">Add</a></li>
                    <li class="{{ isset($subMenu) && ($subMenu == 'permission_management_list')?'active':'' }}"><a href="{{ url('administrator/permission_management/list') }}">List</a></li>
                   
                </ul>
            </li>
            <li class="{{ isset($menu) && ($menu == 'patient')?'active':'' }}">
                <a href="{{ url('administrator/patient/list') }}"><i class="fa fa-list"></i> <span class="nav-label">Patient management</span></a>
            </li>
            <li class="{{ isset($menu) && ($menu == 'doctor')?'active':'' }}">
                <a href="{{ url('administrator/doctor/list') }}"><i class="fa fa-list"></i> <span class="nav-label">Doctor management</span></a>
            </li>
            <li class="{{ isset($menu) && ($menu == 'hospital')?'active':'' }}">
                <a href="{{ url('administrator/hospital/list') }}"><i class="fa fa-list"></i> <span class="nav-label">Hospital management</span></a>
            </li>
            <li class="{{ isset($menu) && ($menu == 'lab')?'active':'' }}">
                <a href="{{ url('administrator/lab/list') }}"><i class="fa fa-list"></i> <span class="nav-label">Lab management</span></a>
            </li>
           
          
           
        </ul>

    </div>
</nav>