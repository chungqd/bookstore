</section>
    <section class="span3">
        <div class="side-holder">
            <article class="banner-ad">
                <img src="public/images/khuyenmai.jpg" alt=""/>
            </article>
        </div>
        <div class="side-holder">
            <article class="shop-by-list">
                <h2>Danh mục sản phẩm</h2>
                <div class="side-inner-holder">
                    <strong class="title">Thể loại</strong>
                    <ul class="side-list">
                    <?php foreach($typeBook as $k => $type): ?>
                        <li><a href="?cn=typebook&m=index&id=<?php echo $type['id_loai']; ?>"><?php echo $type['TenLoai']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>

                    <strong class="title">Giá</strong>
                    <ul class="side-list">
                        <li><a href="?cn=price&m=index&id=1">Từ 0đ - 49,000đ</a></li>
                        <li><a href="?cn=price&m=index&id=2">Từ 50,000đ - 99,000đ</a></li>
                        <li><a href="?cn=price&m=index&id=3">Lớn hơn 100,000đ</a></li>
                    </ul>
                    <strong class="title">Tác giả</strong>
                    <ul class="side-list">
                    <?php foreach($author as $k => $au): ?>
                        <li><a href="?cn=author&m=index&id=<?php echo $au['id_tg']; ?>"><?php echo $au['TenTG']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                    <strong class="title">Nhà xuất bản</strong>
                    <ul class="side-list">
                    <?php foreach($publisher as $k => $pb): ?>
                        <li><a href="?cn=publisher&m=index&id=<?php echo $pb['id_nxb']; ?>"><?php echo $pb['TenNXB']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </article>
        </div>
      <!--   <div class="side-holder">
            <article class="l-reviews">
                <h2>Sách xem nhiều nhất</h2>
                <div class="side-inner-holder">
                    <article class="r-post sach_xem_nhieu">
                        <div class="r-img-title">
                            <a href="#"><img src=""/></a>
                            <div class="r-det-holder span6">
                                <strong class="r-author">Tên sách: <a href="#">Dế mèn phiêu lưu kí</a></strong>
                            </div>
                            <div class="r-det-holder span6">
                                <span class="r-by">Tên tác giả:<a href="#">Tô Hoài</a></span>
                                <span class="r-by">Giá: 120000 đ</span>
                                <span class="r-by">Số lượt xem: 355</span>
                            </div>
                        </div>
                    </article>
                </div>
            </article>
        </div> -->
    </section>
  </section>
</section>