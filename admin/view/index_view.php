<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../public/css/style2.css">
    <script src="../public/js/jquery-1.12.0.min.js"></script>
</head>
<body>
    <div class="container">
            <div class="login-box animated fadeInUp" style="max-width:340px">
            <div class="row" style="padding: 10px;">
                <?php if (isset($checkFlag)): ?>
                    <ul>  
                    <?php foreach ($checkData as $key => $err): ?>
                        <?php if(!empty($err)): ?>
                            <li><?php echo $err; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php if (isset($mess)): ?>
                    <h3><?php echo $mess; ?></h3>
                <?php endif; ?>
            </div>
                <form action="index.php" method="POST" >
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
                </form>
            </div>
    </div>
</body>
</html>