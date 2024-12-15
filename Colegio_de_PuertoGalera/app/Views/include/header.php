<header id="header">
    <!-- header two area start -->
    <div class="header-two">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-sm-6 d-block d-lg-none">
                    <div class="logo">
                        <a href="/"><img src="assets/images/icon/colegiologo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-9 offset-lg-1 d-none d-lg-block">
                    <div class="main-menu menu-style2">
                        <nav>
                            <ul id="m_menu_active">
                                <li class="active"><a href="/">Home</a></li>
                                <li><a href="/aboutus">About</a></li>
                                <li><a href="javascript:void(0);">Courses</a>
                                    <ul class="submenu">
                                        <li><a href="/courses">Courses</a></li>
                                        <!--<li><a href="course-details.html">Course details</a></li>-->
                                        <li><a href="/admission">Admission</a></li>
                                    </ul>
                                </li>
                                <li><a href="/teachers">Teachers</a>
                                    <!--<ul class="submenu">-->
                                    <!--    <li><a href="/teachers">Teachers</a></li>-->
                                    <!--    <li><a href="teacher-details.html">Teacher details</a></li>-->
                                    <!--</ul>-->
                                </li>
                                <li class="middle-logo">
                                    <a href="/">
                                        <img src="assets/images/icon/colegiologo.png" alt="logo">
                                    </a>
                                </li>
                                <li><a href="/events">Events</a>
                                    <!--<ul class="submenu">-->
                                    <!--    <li><a href="/events">Events List</a></li>-->
                                    <!--    <li><a href="blog-details.html">Event Details</a></li>-->
                                    <!--</ul>-->
                                </li>
                                <li><a href="/news">News</a>
                                    <!--<ul class="submenu">-->
                                    <!--    <li><a href="/news">News</a></li>-->
                                    <!--    <li><a href="blog-details.html">News details</a></li>-->
                                    <!--</ul>-->
                                </li>
                                <li><a href="/contact">Contact</a></li>
                                    <?php if (session()->get('isLoggedIn')): ?>
                                    <li>
                                        <a href="javascript:void(0);">Menu</a>
                                        <ul class="submenu">
                                            <?php if (session()->get('email') == 'degaleracolegio@gmail.com'): ?> <!-- Check if the user is an admin -->
                                                <li><a href="/admin/profile/1">Profile</a></li>
                                            <?php else: ?> <!-- For regular users -->
                                                <li><a href="/profile">Profile</a></li>
                                            <?php endif; ?>
                                            <li><a href="/signin" onclick="return confirm('Are you sure you want to log out?');">Logout</a></li> <!-- Log out link -->
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-3">
                    <div class="header-bottom-right-style-2">
                        <ul>
                            <!-- Show Log in and Sign up buttons if user is not logged in -->
                            <?php if (!session()->get('isLoggedIn')): ?>
                                <li><a class="btn btn-light btn-round" href="/signin">Log in</a></li>
                                <li><a class="btn btn-primary btn-round" href="/signup">Sign Up</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="col-12 d-block d-lg-none">
                    <div id="mobile_menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- header two area end -->
</header>
<style>
    .welcome-message {
    font-size: 1.1em; /* Change to your desired size */
    font-weight: bold; /* Optional: makes the text bold */
    margin-bottom: 0.2em; /* Optional: adds some space below the message */
}
</style>