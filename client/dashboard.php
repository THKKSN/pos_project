<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
// check_login();
require_once('partials/_head.php');
require_once('partials/_analytics.php');
?>
<body>
<?php
    require_once('partials/_sidebar.php');
    ?>

  <div class="main-content">
  

    <?php
    require_once('partials/_topnav.php');
    ?>
    <div style="background-image: url(assets/img/theme/client); background-size: cover;"
      class="header  pb-8 pt-5 pt-md-8"> </div>
    <span class="mask bg-gradient-dark opacity-8"></span>
    <div class="container-fluld">
      <div class="header-body">
        <div class="row">
        <div class="col-xl-3 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">ลูกค้า</h5>
                  <span class="h2 font-weight-bold mb-0"><?php echo $customers; ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">สินค้า</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $products; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-utensils"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">คำสั่งซื้อ</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $orders; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-shopping-cart"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">ยอดขาย</h5>
                      <span class="h2 font-weight-bold mb-0">฿<?php echo $sales; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                        <i class="fas fa-dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr><!-- For more projects: Visit codeastro.com  -->
                    <th class="text-success" scope="col"><b>Code</b></th>
                    <th scope="col"><b>Customer</b></th>
                    <th class="text-success" scope="col"><b>Product</b></th>
                    <th scope="col"><b>Unit Price</b></th>
                    <th class="text-success" scope="col"><b>Qty</b></th>
                    <th scope="col"><b>Total</b></th>
                    <th scop="col"><b>Status</b></th>
                    <th class="text-success" scope="col"><b>Date</b></th>
                  </tr>
                </thead>
                <?php
                $ret = "SELECT * FROM `order` ORDER BY `createdAt` DESC LIMIT 7"; 
                
                // เตรียมคำสั่ง SQL
                if ($stmt = $mysqli->prepare($ret)) {
                  // หาก prepare สำเร็จให้ execute
                  $stmt->execute();
                  $res = $stmt->get_result();

                  // วนลูปผลลัพธ์
                  while ($order = $res->fetch_object()) {
                    $total = ($order->prod_price * $order->prod_qty);
                    // แสดงข้อมูล
                  }
                } else {
                  // หาก prepare ล้มเหลว ให้แสดงข้อผิดพลาด
                  die("Prepare failed: " . $mysqli->error);
                }
                ?>
                </table>
              </div>
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php require_once('partials/_footer.php'); ?>
  </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>