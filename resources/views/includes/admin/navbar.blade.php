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
                <a class="nav-link sidenav-item" href="{{url('plot')}}"><img src="{{asset('public/assets/images/plots.svg')}}" class="icon-white pr-2" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-plots.png')}}" class="icon-blue pr-2" width="30" height="30">
                    All Plots</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="{{url('client')}}"><img src="{{asset('public/assets/images/client.svg')}}" class="pr-2 icon-white" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-client.png')}}" class="pr-2 icon-blue" width="30" height="30">
                    All Clients</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="{{url('manager')}}"><img src="{{asset('public/assets/images/manager.svg')}}" class="pr-2 icon-white" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-manager.png')}}" class="pr-2 icon-blue" width="30" height="30">
                    All Managers</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="#"><img src="{{asset('public/assets/images/terms.svg')}}" class="pr-2 icon-white" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-term.png')}}" class="pr-2 icon-blue" width="30" height="30">
                    Terms & Conditions</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link sidenav-item" href="#"><img src="{{asset('public/assets/images/policy.svg')}}" class="pr-2 icon-white" width="30" height="30">
                    <img src="{{asset('public/assets/images/blue-policy.png')}}" class="pr-2 icon-blue" width="30" height="30">
                    Privacy Policy</a>
            </li>

        </ul>
        <form class="form-inline  mt-2 mt-md-0 search-field-outer">
            <div class="form-group has-search-input search-field-inner">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control search-field" placeholder="Search">
            </div>
        </form>
        <form class="form-inline  mt-2 mt-md-0 ml-auto navbar-header-right-section pt-2 pt-lg-0">
            <div class="form-group has-search mr-4">
                <div class="dropdown">
                    <img src="{{asset('public/assets/images/bn-bell-icon.svg')}}" class="dropdown-toggle icon-button" id="dropdownMenuButton" data-toggle="dropdown">
                    <span class="icon-button__badge"></span>
                    <div class="dropdown-menu notification-dropdown" aria-labelledby="dropdownMenuButton">
                        <a class="notification-area " href="#">
                            <div class="notification-profile d-flex py-3">
                                <img src="{{asset('public/assets/images/profile.svg')}}">
                                <p class="pl-3"><span>Dayut Carlotte</span>wants to update his access level from
                                    view to edit</p>
                            </div>
                        </a>
                        <a class=" notification-area" href="#">
                            <div class="notification-profile d-flex py-3">
                                <img src="{{asset('public/assets/images/profile.svg')}}">
                                <p class="pl-3"><span>Dayut Carlotte</span>wants to update his <br>access level from
                                    view to edit</p>
                            </div>
                        </a>
                        <a class=" notification-area" href="#">
                            <div class="notification-profile d-flex py-3">
                                <img src="{{asset('public/assets/images/profile.svg')}}">
                                <p class="pl-3"><span>Dayut Carlotte</span>wants to update his <br>access level from
                                    view to edit</p>
                            </div>
                        </a>
                        <a class=" notification-area" href="#">
                            <div class="notification-profile d-flex py-3">
                                <img src="{{asset('public/assets/images/profile.svg')}}">
                                <p class="pl-3"><span>Dayut Carlotte</span>wants to update his <br>access level from
                                    view to edit</p>

                            </div>
                        </a>
                        <a class=" notification-area" href="#">
                            <div class="notification-profile d-flex py-3">
                                <img src="{{asset('public/assets/images/profile.svg')}}">
                                <p class="pl-3"><span>Dayut Carlotte</span>wants to update his <br>access level from
                                    view to edit</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="form-group has-search profile mr-4">
                <img src="{{asset('public/assets/images/profile.svg')}}" class="mr-2">
                <span>Name here</span>
            </div>
            <div class="form-group has-search">
                <div class="dropdown dropdown-logout">
                    <img src="{{asset('public/assets/images/arrow-down.svg')}}" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                    <div class="dropdown-menu text-center logout-dropdown" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item logout" href="#"><i class="fa fa-sign-out pr-2" aria-hidden="true"></i>Logout</a>

                    </div>
                </div>
            </div>
        </form>
    </div>
</nav>