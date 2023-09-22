<div class="navbar-vertical navbar nav-dashboard">
    <div class="h-100" data-simplebar>
        <!-- Brand logo -->
<center>
    <img src="{{asset('assets/images/logo02.png')}} " width="95px" height="130px"
    alt="Store" class="w-auto">
</center>
        
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link has-arrow" {{ Route::current()== 'home' ? 'active' :'' }} href="{{ route('home') }}">
                    <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>
                    {{__('Dashboard')}}
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link has-arrow" {{ Route::current()== 'home' ? 'active' :'' }} href="{{ route('Category.index') }}">
                    <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>
                    {{__('Category')}}
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link has-arrow" {{ Route::current()== 'home' ? 'active' :'' }} href="{{ route('Product.index') }}">
                    <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>
                    {{__('Product')}}
                </a>
            </li>
        </ul>
    </div>
</div>