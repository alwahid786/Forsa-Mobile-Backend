<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-header">
    <a class="navbar-brand logo-header" href="#">
        <img src="{{asset('public/assets/images/admin_logo3.png')}}" alt="Admin logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
            <li class="nav-item ">
                <a class="nav-link sidenav-item dasboard-link" href="{{url('dashboard')}}">
                    <img src="{{asset('public/assets/images/side-dashboard.svg')}}" class="icon-white pr-2" width="30" height="30">
                    <img src="{{asset('public/assets/images/dash.png')}}" class="icon-blue pr-2" width="30" height="30">
                    Dashboard<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="#"><img src="{{asset('public/assets/images/plots.svg')}}" class="icon-white pr-2" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-plots.png')}}" class="icon-blue pr-2" width="30" height="30">
                    All Vendors</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="#"><img src="{{asset('public/assets/images/plots.svg')}}" class="icon-white pr-2" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-plots.png')}}" class="icon-blue pr-2" width="30" height="30">
                    All Users</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="#"><img src="{{asset('public/assets/images/plots.svg')}}" class="icon-white pr-2" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-plots.png')}}" class="icon-blue pr-2" width="30" height="30">
                    Categories</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="#"><img src="{{asset('public/assets/images/plots.svg')}}" class="icon-white pr-2" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-plots.png')}}" class="icon-blue pr-2" width="30" height="30">
                    Sub Categories</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="#"><img src="{{asset('public/assets/images/plots.svg')}}" class="icon-white pr-2" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-plots.png')}}" class="icon-blue pr-2" width="30" height="30">
                    Banners</a>
            </li>

        </ul>
        <form class="form-inline  mt-2 mt-md-0 ml-auto navbar-header-right-section pt-2 pt-lg-0">
          
            <div class="form-group has-search profile mr-4">
                <!-- <img src="{{asset('public/assets/images/profile.svg')}}" class="mr-2"> -->
                <span>{{auth()->user()->name}}</span>
            </div>
            <div class="form-group has-search">
                <div class="dropdown dropdown-logout">
                    <img src="{{asset('public/assets/images/arrow-down.svg')}}" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                    <div class="dropdown-menu text-center logout-dropdown" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item logout" href="{{ route('logout') }}"><i class="fa fa-sign-out pr-2" aria-hidden="true"></i>Logout</a>

                    </div>
                </div>
            </div>
        </form>
    </div>
</nav>