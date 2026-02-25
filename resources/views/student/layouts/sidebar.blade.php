<div class="leftside-menu">

<!-- Brand Logo Light -->
<a href="{{route('student.dashboard')}}" class="logo logo-light" style="background:white">
    <span class="logo-lg">
        <img src="{{asset('frontend/img/logo.png')}}" alt="logo" style="width: 80px;height: 80px;">
    </span>
    <span class="logo-sm">
        <img src="{{asset('frontend/img/logo.png')}}" alt="small logo" style="height: 80px;width: 80px;">
    </span>
</a>

<!-- Brand Logo Dark -->
<a href="{{route('student.dashboard')}}" class="logo logo-dark" style="background:white">
    <span class="logo-lg">
        <img src="{{asset('frontend/img/logo.png')}}" alt="dark logo" style="height: 80px;width: 80px;">
    </span>
    <span class="logo-sm">
        <img src="{{asset('frontend/img/logo.png')}}" alt="small logo" style="height: 80px;width: 80px;">
    </span>
</a>

<!-- Sidebar Hover Menu Toggle Button -->
<div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
    <i class="ri-checkbox-blank-circle-line align-middle"></i>
</div>

<!-- Full Sidebar Menu Close Button -->
<div class="button-close-fullsidebar">
    <i class="ri-close-fill align-middle"></i>
</div>

<!-- Sidebar -left -->
<div class="h-100" id="leftside-menu-container" data-simplebar>
    <!-- Leftbar User -->
    <div class="leftbar-user">
        <a href="pages-profile.html">
            <img src="{{asset('student/assets/images/users/avatar-1.jpg')}}" alt="user-image" height="42" class="rounded-circle shadow-sm">
            <span class="leftbar-user-name mt-2">Tosha Minner</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">

        <li class="side-nav-title">Navigation</li>

        <li class="side-nav-item">
            <a  href="{{url('/student/dashboard')}}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                <i class="ri-home-4-line"></i>
                <span class="badge bg-success float-end">2</span>
                <span> Dashboards </span>
            </a>
            
        </li>


        <li class="side-nav-item">
            <a href="{{route('student.booking')}}" class="side-nav-link">
                <i class="ri-calendar-event-line"></i>
                <span> My Bookings </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{route('student.coins')}}" class="side-nav-link">
                <i class="ri-message-3-line"></i>
                <span> My Coins </span>
            </a>
        </li>


        <li class="side-nav-item">
            <a href="{{route('logout')}}" class="side-nav-link">
                <i class="ri-message-3-line"></i>
                <span>Logout </span>
            </a>
        </li>

        <!-- <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                <i class="ri-mail-line"></i>
                <span> Email </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarEmail">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="apps-email-inbox.html">Inbox</a>
                    </li>
                    <li>
                        <a href="apps-email-read.html">Read Email</a>
                    </li>
                </ul>
            </div>
        </li> -->

       

    </ul>
    <!--- End Sidemenu -->

    <div class="clearfix"></div>
</div>
</div>