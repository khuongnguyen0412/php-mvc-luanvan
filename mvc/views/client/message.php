<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
<?php
      $cart = new cart();
      $total = (isset($cart->getTotalQuantitycart()['total']) ? $cart->getTotalQuantitycart()['total'] : 0);
      
      $category = $this->model("categoryModel");
      $result = $category->getAllClient();
      $listCategory = $result->fetch_all(MYSQLI_ASSOC);
      ?>
      <nav class="navbar">
        <div class="logo">HUYPHAM STORE</div>
        <ul class="nav-links">
          <input type="checkbox" id="checkbox_toggle" />
          <label for="checkbox_toggle" class="hamburger">&#9776;</label>
          <div class="menu">
            <li><a href="<?= URL_ROOT ?>">Trang chủ <i class="fa fa-home"></i></a></li>
            <li class="cate">
              <a href="#">Danh mục <i class="fa fa-list-ul"></i></a>
              <ul class="sub-menu">
                <?php
                foreach ($listCategory as $key) { ?>
                  <li><a href="<?= URL_ROOT . '/product/category/' . $key['id'] ?>?page=1"><?= $key['name'] ?></a></li>
                <?php }
                ?>
              </ul>
            </li>
            <li><a href="#">Giới thiệu <i class="fa fa-info-circle"></i></a></li>
            <?php
            if (isset($_SESSION['user_id'])) { ?>
              <li class="cate">
                <a href="#"><?= $_SESSION['user_name'] ?> <i class="fa fa-user-circle"></i></a>
                <ul class="sub-menu">
                  <li><a href="<?= URL_ROOT . "/user/info" ?>">Thông tin tài khoản <i class="fa fa-user"></i></a></li>
                  <li><a href="<?= URL_ROOT . "/order/checkout" ?>">Đơn hàng của tôi <i class="fa fa-list-alt"></i></a></li>
                  <li><a href="<?= URL_ROOT . "/user/logout" ?>">Đăng xuất <i class="fa fa-sign-out"></i></a></li>
                </ul>
              </li>
            <?php  } else { ?>
              <li><a href="<?= URL_ROOT . "/user/register" ?>">Đăng ký <i class="fa fa-pencil-square"></i></a></li>
              <li><a href="<?= URL_ROOT . "/user/login" ?>">Đăng nhập <i class="fa fa-sign-in"></i></a></li>
              <li><a href="<?= URL_ROOT . "/product/viewed" ?>">Đã xem <i class="fa fa-history"></i></a></li>
            <?php  }
            ?>
            <li><a href="<?= URL_ROOT . "/cart/checkout" ?>" id="bag">Giỏ hàng <i class="fa fa-shopping-bag"></i> (<?= is_null($total) ? 0 : $total ?>)</a></li>
          </div>
        </ul>
      </nav>
    <?php require_once APP_ROOT . '/core/Config.php'; ?>
    <div class="banner">

    </div>
    <div class="title">Thông báo</div>
    <div class="message-container">
        <h2 class="success"><?= $data['message'] ?></h2>
        <h3><?= isset($data['thanks']) ? $data['thanks'] : "" ?></h3>
        <a href="<?= URL_ROOT ?>" class="cart-btn">Tiếp tục mua hàng</a>
    </div>
    <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>