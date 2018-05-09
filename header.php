<nav class="navbar navbar-default ">
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
                    <a class="navbar-brand" href="/facilities">
                        Rowan Parking
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->



                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">


                        <!-- Authentication Links -->
                       <?php if(!isset($_SESSION['login'])){ ?>
                            <li><a href="contact_us.php">Contact Us</a></li>
			    <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
					   <?php } else { ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-user"></i> <?php echo (isset($_SESSION['user']) ? $_SESSION['user'] : " User" ); ?> <i
                                        class="fa fa-caret-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                        <li> <a href="/facilities/admin_page.php">
                                    Admin Page
                                </a></li>                 
						 <li role="presentation" class="divider"></li>
                            <li>
                                <a href="/facilities/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>
                                </ul>
                        </li>
						
					   <?php } ?>
                       
                    </ul>
                </div>
            </div>
        </nav>
