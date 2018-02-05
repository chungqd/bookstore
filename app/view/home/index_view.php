<div id="right">
<div class="row"><div class="col-md-12">
  <h2>Sách mới</h2>
  <section class="grid-holder features-books">
  <?php foreach ($dataAllBook as $key => $b) : ?>
      <figure class="span4 slide first chinh1">
          <a href="?cn=index&m=detail&name=<?php echo vn2latin($b['TenSach']).'-'.$b['id']; ?>"><img src="<?php echo PATH_IMG_BOOK . $b['HinhAnh']; ?>" alt="" class="pro-img"/></a>
          <p>
              <span class="title">
                  <a href="?cn=index&m=detail&name=<?php echo vn2latin($b['TenSach']).'-'.$b['id']; ?>" style="font-weight: bold"><?php echo $b['TenSach']; ?></a>
              </span>
          </p>
          <p>Thể loại:
              <a class="nxb" href="?cn=typebook&m=index&id=<?php echo $b['id_loai']; ?>"><?php echo $b['TenLoai']; ?></a>
          </p>
          <p>Tác giả:
              <a class="nxb" href="?cn=author&m=index&id=<?php echo $b['id_tg']; ?>"><?php echo $b['TenTG']; ?></a>
          </p>
          <p>Nhà xuất bản:
              <a class="nxb" href="?cn=publisher&m=index&id=<?php echo $b['id_nxb']; ?>"><?php echo $b['TenNXB']; ?></a>
          </p>
          <p>Lượt xem:
            <span><?php echo $b['SoLuotXem']; ?></span>
          </p>
          <div class="cart-price">
              <a class="cart-btn2" href="?cn=cart&m=add&id=<?php echo $b['id']; ?>">Thêm vào giỏ hàng</a>
              <span class="price"><?php echo (empty($b['GiaMoi']))?number_format($b['GiaCu']):number_format($b['GiaMoi']); ?> đ</span>
          </div>
      </figure>
  <?php endforeach; ?>
  </section>
</div></div>  <?php echo $dataPaging['html']; ?>
</div>
