<?php
session_start();
include('config/config.php'); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบเมื่อผู้ใช้ทำการล็อกอิน
if (isset($_POST['login'])) {
  $_username = $_POST['_username'];
  $_password = $_POST['_password']; // รับรหัสผ่านดิบที่ผู้ใช้กรอกจากฟอร์ม

  // ดึงข้อมูลรหัสผ่านที่แฮชแล้วจากฐานข้อมูล
  $stmt = $mysqli->prepare("SELECT _id, _password FROM login WHERE _username = ?");
  if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
  }
  
  // ผูกค่า username ที่ได้รับจากฟอร์ม
  $stmt->bind_param('s', $_username);
  $stmt->execute();
  $stmt->bind_result($_id, $_password_db); // ดึงข้อมูลรหัสผ่านแฮชจากฐานข้อมูล
  
  // ตรวจสอบว่าพบ username หรือไม่
  if ($stmt->fetch()) {
    // เปรียบเทียบรหัสผ่านที่ผู้ใช้กรอกกับรหัสผ่านที่ถูกแฮชในฐานข้อมูล
    if (sha1(md5($_password)) === $_password_db) {
      // ถ้ารหัสผ่านถูกต้อง ให้เก็บ session และเปลี่ยนไปหน้า dashboard
      $_SESSION['_id'] = $_id;
      header("Location: dashboard2.php");
      exit();
    } else {
      $err = "Incorrect Password.";
    }
  } else {
    $err = "Incorrect Username.";
  }
  
  // ปิดการทำงานของ statement
  $stmt->close();
}

require("partials/_head.php");
?>
<body  class="bg-dark">
  <div class="main-content">
    <div class="header bg-gradient-primar py-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Login Point Of Sale System</h1>
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
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" required name="_username" placeholder="Username" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" required name="_password" placeholder="Password" type="password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember Me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary my-4">Log In</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <!-- <a href="forgot_pwd.php" class="text-light"><small>Forgot password?</small></a> -->
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
