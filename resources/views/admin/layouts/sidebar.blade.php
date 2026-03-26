<div class="leftside-menu">

<!-- Brand Logo Light -->
<a href="{{route('admin.dashboard')}}" class="logo logo-light">
    <span class="logo-lg">
        <img src="{{asset('frontend/img/logo.png')}}" alt="logo">
    </span>
    <span class="logo-sm">
        <img src="{{asset('frontend/img/logo.png')}}" alt="small logo">
    </span>
</a>

<!-- Brand Logo Dark -->
<a href="{{route('admin.dashboard')}}" class="logo logo-dark">
    <span class="logo-lg">
        <img src="assets/images/logo-dark.png" alt="dark logo">
    </span>
    <span class="logo-sm">
        <img src="assets/images/logo-sm.png" alt="small logo">
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
            <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
            <span class="leftbar-user-name mt-2">Tosha Minner</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">

        <li class="side-nav-title">Navigation</li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                <i class="ri-home-4-line"></i>
               
                <span> Dashboards </span>
            </a>
           
        </li>

        <li class="side-nav-title">Students</li>

       <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#offline" aria-expanded="false" aria-controls="offline" class="side-nav-link">
               
                <span> Offline </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="offline">
                <ul class="side-nav-second-level">
                     <li>
                        <a href="{{route('all.zone')}}">Zone</a>
                    </li>
                    <li>
                        <a href="{{route('all.offline.batch')}}">Batch</a>
                    </li>
                 <li>
                        <a href="{{route('all.offline.mocktest.volume')}}">Mock Test Volume</a>
                 </li>
                </ul>
            </div>
        </li>


        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
               
                <span>👥 All Students </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarEmail">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('all.students')}}">👥 Students</a>
                    </li>
                  
                </ul>
            </div>
        </li>




        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#notes" aria-expanded="false" aria-controls="notes" class="side-nav-link">
               
                <span>📒  Daily Current Afair </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="notes">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('all.notes')}}">📒 All DCA</a>
                    </li>
                     <li>
                        <a href="{{route('mock_test.all')}}">📒 All Mock Test</a>
                    </li>
                    <li>
                        <a href="{{route('admin.create_magazine')}}">📒 Create Magazine</a>
                    </li>
                </ul>
            </div>
        </li>



        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#my_cources" aria-expanded="false" aria-controls="my_cources" class="side-nav-link">
               
                <span>📕 My Courses </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="my_cources">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('all.courses')}}">📕 All Courses</a>
                    </li>
                  
                </ul>
            </div>
        </li>


        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#live_class" aria-expanded="false" aria-controls="live_class" class="side-nav-link">
               
                <span>🖥️ Live Class </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="live_class">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('class.all')}}">🖥️ Classroom</a>
                    </li>
                  
                </ul>
            </div>
        </li>


        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#test_volume" aria-expanded="false" aria-controls="test_volume" class="side-nav-link">
               
                <span>📚 All Test </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="test_volume">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('test.all')}}">📚 Test Volume</a>
                    </li>
                  
                </ul>
            </div>
        </li>
        
         <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#add_notes" aria-expanded="false" aria-controls="add_notes" class="side-nav-link">
               
                <span>📝 All Notes </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="add_notes">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('pdfnotes.all')}}">📝 Add Notes</a>
                    </li>
                  
                </ul>
            </div>
        </li>



        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#hard_copy" aria-expanded="false" aria-controls="hard_copy" class="side-nav-link">
               
                <span>📄 Hard Copy </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="hard_copy">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{url('pdfnotes.all')}}">📄 Add Hard</a>
                    </li>
                  
                </ul>
            </div>
        </li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#add_recording" aria-expanded="false" aria-controls="add_recording" class="side-nav-link">
               
                <span>🎙️ All Recording </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="add_recording">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('recording.all')}}">🎙️ Add Recording</a>
                    </li>
                  
                </ul>
            </div>
        </li>



        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#questions" aria-expanded="false" aria-controls="questions" class="side-nav-link">
                <span>📖 All Questions </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="questions">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('questions.all')}}">📖 Create Questions</a>
                    </li>
                  
                </ul>
            </div>
        </li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#packages" aria-expanded="false" aria-controls="packages" class="side-nav-link">
                <span>📦 All Packages </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="packages">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('packages.all')}}">📦 Create Packages</a>
                    </li>
                  
                </ul>
            </div>
        </li>
 <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#packages" aria-expanded="false" aria-controls="packages" class="side-nav-link">
                <span>📦 All Coupons </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="packages">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('coupon.all')}}">📦 Create Coupons</a>
                    </li>
                  
                </ul>
            </div>
        </li>

<li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#Language" aria-expanded="false" aria-controls="packages" class="side-nav-link">
                <span> All Language </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="Language">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('admin.language')}}">📦 Language Coupons</a>
                    </li>
                  
                </ul>
            </div>
        </li>
<li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#Category" aria-expanded="false" aria-controls="packages" class="side-nav-link">
                <span> All Category </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="Category">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('category.all')}}">📦 All Category</a>
                    </li>
                  
                </ul>
            </div>
        </li>
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#Blogs" aria-expanded="false" aria-controls="packages" class="side-nav-link">
                <span> All Blogs </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="Blogs">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{route('blog.all')}}">📦 All Blogs</a>
                    </li>
                  
                </ul>
            </div>
        </li>
       
        

        <li class="side-nav-item">
            <a href="{{route('logout')}}" class="side-nav-link">
                <i class="fa fa-sign-out"></i>
               
                <span> Logout </span>
            </a>
           
        </li>

       
    

    </ul>
    <!--- End Sidemenu -->

    <div class="clearfix"></div>
</div>
</div>