<?php
session_start();
include('config/config.php');


if (isset($_POST['register'])) {
    
    $_username = $_POST['_username'];
    $_password = password_hash($_POST['_password'], PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Insert into the users table first and get the user_id
    $stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }
    
    $stmt->bind_param('ss', $first_name, $last_name);
    if ($stmt->execute()) {
        $user_id = $mysqli->insert_id; // Get the generated user_id
    } else {
        $err = "Failed to insert into users table: " . $mysqli->error;
        die($err); // Stop if there's an error
    }

    // ตรวจสอบว่าชื่อผู้ใช้มีอยู่ในตาราง login หรือไม่
    $stmt = $mysqli->prepare("SELECT _id FROM login WHERE _username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param('s', $_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $err = "Username already taken!";
    } else {
        // ถ้าไม่ซ้ำ ให้บันทึกลงฐานข้อมูลในตาราง login
        $stmt = $mysqli->prepare("INSERT INTO login (_username, _password, first_name, last_name, user_id) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }
        
        $stmt->bind_param('ssssi', $_username, $_password, $first_name, $last_name, $user_id);
        
        if ($stmt->execute()) {
            $_SESSION['_id'] = $mysqli->insert_id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            header("Location: ../../index.php");
        } else {
            $err = "Registration failed, please try again! Error: " . $mysqli->error;
        }
    }
}
require("partials/_head.php");
?>

<body class="bg-dark">
  <div class="main-content">
    <div class="header bg-gradient-primary py-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Register for Point Of Sale System</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form method="post" role="form">
                <div class="form-group mb-3">
                  <input class="form-control" required name="first_name" placeholder="First Name" type="text">
                </div>
                <div class="form-group mb-3">
                  <input class="form-control" required name="last_name" placeholder="Last Name" type="text">
                </div>
                <div class="form-group mb-3">
                  <input class="form-control" required name="_username" placeholder="Username" type="text">
                </div>
                <div class="form-group">
                  <input class="form-control" required name="_password" placeholder="Password" type="password">
                </div>
                <div class="text-center">
                  <button type="submit" name="register" class="btn btn-primary my-4">Register</button>
                </div>
              </form>
              <?php if (isset($err)) { echo "<div class='alert alert-danger'>$err</div>"; } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- footer -->
<?php
  require_once('partials/_footer.php');
?>
<?php
  require_once('partials/_scripts.php');
?>
</body>
</html>
