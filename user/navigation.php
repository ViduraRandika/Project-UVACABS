  <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #000000;">

      <!--NAVIGATION BAR BRAND LOGO-->

      <a class="navbar-brand" href="../index.php"><img src="../img/logo.png" style="width: 40px; height: 40px;" alt="logo"></a>

      <!--TOGGLE BUTTON-->

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navb">

          <ul class="navbar-nav mr-auto">

              <!--NAV BAR ITEMS-->

              <li class="nav-item">
                  <a class="nav-link <?php if ($u == "home") {
                                            echo "active";
                                        } ?>" href="../index.php">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link <?php if ($u == "booking") {
                                            echo "active";
                                        } ?>" href="booking.php">Book Now</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link <?php if ($u == "contactus") {
                                            echo "active";
                                        } ?>" href="contactus.php">Contact Us</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link <?php if ($u == "####") {
                                        echo "active";
                                    } ?>" href="#">Disabled</a>
            </li> -->
          </ul>

          <!--NAV BAR LOGIN AND SIGNUP BUTTONS-->

          <form class="form-inline my-2 my-lg-0">
              <?php if (isset($_SESSION['user'])) {
                ?>
                  <label style="margin-right:20px; color:white;" data-toggle="dropdown"><?php echo $_SESSION['user_data']['customerFname']; ?></label>
                  <div class="dropdown">
                      <i class="dropdown-toggle" style="color: white; margin-right:30px;" data-toggle="dropdown"></i>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="profile.php" style="color: black;">My Profile</a>
                          <a class="dropdown-item" href="verify_identity.php" style="color: red;">Change Password</a>
                          <a class="dropdown-item" href="../index.php?logout='1'" style="color: red;">logout</a>
                      </div>
                  </div>

              <?php } else { ?>
                  <button onclick="window.location.href = '../user/login.php';" class="btn btn-success my-2 my-sm-0 nav_btn_ls" type="button" id="nav_login_btn">Log In</button>
                  <button onclick="window.location.href = '../user/signup.php';" class="btn btn-primary my-2 my-sm-0 nav_btn_ls" type="button" id="nav_signup_btn">SignUp</button>
              <?php } ?>
          </form>

      </div>

  </nav>