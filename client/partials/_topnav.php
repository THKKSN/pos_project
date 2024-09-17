<?php
// $_id = $_SESSION['_id'];
$ret = "SELECT * FROM users WHERE id = ?";
$stmt = $mysqli->prepare($ret);

if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

$stmt->bind_param('i', $_id); // ใช้ค่า _id ที่ได้จาก session
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_object()) {
    // กำหนด $users ให้เป็นข้อมูลที่ได้จากฐานข้อมูล
    $users = $row;
}

$stmt->close();

?>

<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="dashboard.php">dashboard</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="assets/img/theme/user-a-min.png">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm font-weight-bold"></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <a href="change_profile.php" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>My profile</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
