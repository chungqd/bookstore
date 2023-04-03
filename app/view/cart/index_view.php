    <style type="text/css">
    .table > tbody > tr > td {
      vertical-align: middle;
    }
    .myinput{width: 320px;}
    </style>
<div class="container">
      <?php if (!empty($mess1)): ?>
        <div class="row">
          <h3 class="text-center"><?php echo $mess1; ?></h3>
        </div>
      <?php endif ?>
      <?php if (!empty($mess2)): ?>
        <div class="row">
          <h3 class="text-center"><?php echo $mess2; ?></h3>
        </div>
      <?php endif ?>
      <?php if (!empty($mess3)): ?>
        <div class="row">
          <h3 class="text-center"><?php echo $mess3; ?></h3>
        </div>
      <?php endif ?>
      <?php if (!empty($mess4)): ?>
        <div class="row">
          <h3 class="text-center"><?php echo $mess4; ?></h3>
        </div>
      <?php endif ?>
      <div class="heading-bar">
          <a class="more-btn">Tiến hành kiểm tra</a>
      </div>
      <?php if (isset($_SESSION['cart']) OR !empty($_SESSION['cart'])): ?>
      <div class="table_gio_hang">
          <form method="POST" action="?cn=cart&m=edit" id="form_gio_hang">
              <table class="table table-hover table-striped" style="margin: 0px;padding: 0px;">
                  <tr>
                    <th>&nbsp;#</th>
                    <th>Tên sách</th>
                    <th class="center1">Giá</th>
                    <th class="center1">Số lượng</th>
                    <th class="center1" >Thành tiền</th>
                    <th>Xóa</th>
                  </tr>
                  <?php $i=1; foreach ($_SESSION['cart'] as $key => $cart): ?> 
                  <tr>
                    <td class="center1"><?php echo $i; ?>
                    </td>
                    <td><p><?php echo $cart['nameBook']; ?></p>
                    <img src="<?php echo PATH_IMG_BOOK.$cart['imageBook'] ?>" alt="">
                    </td>
                    <td class="center1"><?php echo number_format($cart['cost']); ?></td>
                    <td class="center1" >
                      <input class="soluong1" required pattern="[0-9]{1,3}" title="Số lượng phải là chữ số và nhỏ hơn 4 kí tự" name="txtSoLuong[<?php echo $cart['idBook']; ?>]" size="2" type="text" value="<?php echo $cart['qty']; ?>"/>
                      <!-- <input type="hidden" name="txtIdBook" value="<?php echo $cart['idBook']; ?>"/> -->
                    </td>
                    <td  class="center1 img_gio_hang"><?php echo number_format($cart['qty']*$cart['cost']); ?></td>

                    <td ><a href="?cn=cart&m=delete&id=<?php echo $cart['idBook']; ?>"> <i class="icon-trash"></i></a></td>
                  </tr>
                  <?php $i++; endforeach ?>
                  <tr>
                    <td colspan="6" style="text-align: right">
                      <a href="?cn=index" class="btn btn-primary" title="">Tiếp tục mua hàng</a>

                      <button name="btnSubmit" type="submit" style="" class="btn btn-info">Cập nhật giỏ hàng</button>
                      <a href="?cn=cart&m=remove" class="btn btn-warning">Xóa tất cả</a>
                    </td>
                  </tr>
              </table>
          </form>
      </div>
      <?php endif ?>

      <div class="heading-bar">
        <a class="more-btn">Tiến hành đặt hàng</a>
      </div>
      <div class="table_gio_hang">
        <form id="enableForm3" action="?cn=cart&m=orders" method="POST" class="form-horizontal">
          <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label class="col-md-5 control-label">Họ Tên (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text" value="<?php echo get_session_fullname(); ?>" class="form-control" name="txtHoTen" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Số điện thoại (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text" value="<?php echo get_session_phone(); ?>" class="form-control" name="txtSoDienThoai" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Email (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="email" value="<?php echo get_session_email(); ?>" class="form-control" name="txtEmail" />
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label class="col-md-5 control-label">Địa chỉ (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text"  value="<?php echo get_session_address(); ?>" class="form-control" name="txtDiaChi" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Ghi chú</label>
                  <div class="col-md-7">
                    <textarea style="width: 550px;" name="txtGhiChu" ></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <input type="submit" name="bnSubmit" class="btn btn-info btn-block" value="Đặt hàng"/>
              </div>
          </div>
        </form>
      </div>
</div>