<?php
include_once('header.php');
$user_role = $_SESSION['user_role'];
$username = $_SESSION['user_name'];
?>
<div>

    <!-- svg icons for success or failure message -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <!-- svg icons for success or failure message -->

    <div class="top-header">
        Freight Calculator
    </div>

    <div class="d-flex">
        <!-- Sidebar section starts -->
        <div class="side-bar" id="side-bar">
            <div class="logo-container">
                <a href="home"> <img src="<?php echo $logo_with_name; ?>" class="logo-with-name <?php echo $logo_with_name_class; ?>"> </a>
                <a href="home"> <img src="<?php echo $logo; ?>" class="logo <?php echo $logo_class; ?>"> </a>
            </div>
            <nav class="sidebar-items">


                <div class="nav-items">
                    <a href="home" id="home" class="d-flex" title="Home">
                        <div class="nav-items-icon"> <i class="fas fa-calculator"></i> </div>
                        <div class="nav-items-text"> Calculator </div>
                    </a>
                </div>

                <div class="nav-items">
                    <a href="Entities" id="entities" class="d-flex" title="Entity">
                        <div class="nav-items-icon"> <i class="fas fa-user"></i> </div>
                        <div class="nav-items-text"> Entity </div>
                    </a>
                </div>
                <div class="nav-items">
                    <a href="Customers" id="customers" class="d-flex" title="Customers">
                        <div class="nav-items-icon"> <i class="fas fa-users"></i> </div>
                        <div class="nav-items-text"> Customers </div>
                    </a>
                </div>
                <div class="nav-items">
                    <a href="Rates" id="rates" class="d-flex" title="Rates">
                        <div class="nav-items-icon"> <i class="fas fa-dollar"></i> </div>
                        <div class="nav-items-text"> Rates </div>
                    </a>
                </div>
                <div class="nav-items">
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#target_location" class="d-flex collapsed location" id="location" title="location">
                        <div class="nav-items-icon"> <i class="fas fa-map"></i> </div>
                        <div class="nav-items-text"> Location </div>
                    </a>
                </div>
                <div class="collapse" id="target_location">

                    <div class="nav-items">
                        <a href="Regions" id="regions" class="d-flex" title="regions">&nbsp; &nbsp;
                            <div class="nav-items-icon"> <i class="fas fa-map-pin"></i> </div>
                            <div class="nav-items-text"> Regions </div>
                        </a>
                    </div>

                    <div class="nav-items">
                        <a href="Countries" id="countries" class="d-flex" title="Countries">&nbsp; &nbsp;
                            <div class="nav-items-icon"> <i class="fas fa-flag "></i> </div>
                            <div class="nav-items-text"> Countries </div>
                        </a>

                        <div class="nav-items">
                            <a href="Cities" id="cities" class="d-flex" title="Cities">&nbsp; &nbsp;
                                <div class="nav-items-icon"> <i class="fas fa-city"></i> </div>
                                <div class="nav-items-text"> Cities </div>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="nav-items">
                    <a href="Settings" id="settings" class="d-flex" title="Settings">
                        <div class="nav-items-icon"> <i class="fas fa-gear"></i> </div>
                        <div class="nav-items-text"> Settings </div>
                    </a>
                </div>



                <!-- <div class="nav-items">
                    <a href="ResetPassword" id="resetpassword" class="d-flex" title="Reset Password">
                        <div class="nav-items-icon"> <i class="fas fa-key"></i> </div>
                        <div class="nav-items-text">  Reset Password </div>
                    </a>
                </div> -->

                <div class="nav-items text-center" style="position: absolute; bottom: 0; left: 0; width: 100%; border-top: 1px solid #D0D3D4;">
                    <div class="nav-items-text" style="color: #7f8c8d; font-size: 14px; padding: 5px;">
                        Version: 1.0 (Aug-2024)
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar section ends -->

        <!-- Header section starts -->
        <div class="header" id="header">
            <div class="d-flex align-items-center">
                <div> <i class="fas fa-bars collapse-expand-btn"></i> </div>&nbsp;&nbsp;
                <div class="heading"> Freight Calculator Dashboard</div>
            </div>

            <div class="d-flex header-right-bar">
                <?php
                $full_name = $_SESSION['full_name'];
                $full_name = explode(" ", $full_name);
                $name = strtolower($full_name[0]);
                if (count($full_name) > 1) {
                    if ($name == "muhammad" || $name == "mohammad") {
                        $_fullname = $full_name[1];
                    } else {
                        $_fullname = $full_name[0];
                    }
                } else {
                    $_fullname = $full_name[0];
                }
                ?>
                <div class="user-name"> Welcome <span> <?php echo $_fullname; ?> </span> </div>&nbsp;&nbsp;

                <div class="dropdown">
                    <div class="profile-picture" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/user-icon.png">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-list" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="signout">
                                <img src="images/logout.svg" width="18px">&nbsp;&nbsp; Sign out
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="signout">
                    <a href="signout" title="Sign out">
                        <img src="images/logout.svg" width="18px">&nbsp; Sign out
                    </a>
                </div>
            </div>
        </div>
        <!-- Header section ends -->

        <!-- Session timeout modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content session-expired-container">
                    <div class="text-left pt-4 main-container">
                        <div class="d-flex align-items-center">
                            <div class="icon">
                                <img src="images/warning.png">
                            </div>
                            <div class="text">
                                <div>
                                    <h5> Your session has expired </h5>
                                </div>
                                <div style="margin-top:-2px"> Please log in again to continue using the app </div>
                            </div>
                        </div>
                        <div class="text-end pt-3">
                            <button type="button" class="btn btn-sm btn-secondary login-again"> Log In </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Session timeout modal -->
    </div>
</div>

<script src="js/navbar.js?clear_cache=<?php echo time(); ?>"></script>