<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="public/css/style2.css">
    <script src="public/js/jquery-1.12.0.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="login-box animated fadeInUp" style="max-width:340px">
    <?php if (isset($_SESSION['err']) && !empty($_SESSION['err'])): ?>
        <div class="row">
            <ul>
                <?php foreach ($_SESSION['err'] as $key => $value): ?>
                    <?php if (!empty($value)): ?>
                        <li style="color: red;"><?php echo $value; ?></li>
                    <?php endif; ?>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['err1']) && !empty($_SESSION['err1'])): ?>
        <div class="row">
            <h3 style="color: red;"><?php echo $_SESSION['err1']; ?></h3>
        </div>
    <?php endif; ?>
      <form action="?cn=login&m=dangnhap" method="POST" >
        <div class="box-header">
          <h2>Đăng nhập</h2>
        </div>
        <label for="username">Tên đăng nhập</label>
        <br/>
        <input type="text" name="txtTenDangNhap" id="username">
        <br/>
        <label for="password">Mật khẩu</label>
        <br/>
        <input type="password" name="txtMatKhau" id="password">
        <br/>
        <input type="submit" name="btnSubmit" value="Đăng nhập"/>
        <input type="reset" name="btnReset" value="reset"/>
        <br/>
        <a href="signup.php" title="">Đăng ký</a>
        <span>|</span>
        <a href="index.php" title="">Trang chủ</a>
      </form>
    </div>
  </div>
</body>
</html>