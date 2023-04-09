<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
           <div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Edit Book</h2>
					<h2><?php $msg->display(); ?></h2>
					<?php if (isset($_SESSION['error']) && !empty(isset($_SESSION['error']))) { ?>
						<div class="row">
							<ul>
								<?php foreach ($_SESSION['error'] as $key => $value): ?>
									<?php if (!empty($value)): ?>
										<li style="color: red;"><?php echo $value; ?></li>
									<?php endif ?>
								<?php endforeach ?>

							</ul>
						</div>
					<?php } ?>
					<a href="?sk=book" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
						<form action="?sk=book&m=edit&id=<?php echo $infoBook['id']; ?>" method="post" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="txtNameBook">Tên Sách</label>
						    <input type="text" class="form-control" name="txtNameBook" id="txtNameBook" placeholder="Tên Sách" value="<?php echo $infoBook['TenSach']; ?>">
						    <input type="hidden" name="txthddNameBook" value="<?php echo $infoBook['TenSach']; ?>">
						  </div>
						  <div class="form-group">
						    <label for="slcAuthor">Chọn tác giả</label>
						    <select name="slcAuthor" class="form-control"> 
							    <?php foreach ($dataAuthor as $key => $au): ?>
							    	<option value="<?php echo $au['id_tg']; ?>" <?php echo ($au['id_tg'] == $infoBook['id_tg'])?'selected="selected"':""; ?> ><?php echo $au['TenTG']; ?></option> 
							    <?php endforeach; ?>
						    </select>
						  </div>
						  
						  <div class="form-group">
						    <label for="slcPublisher">Chọn nhà xuất bản</label>
						    <select name="slcPublisher" class="form-control"> 
						    	 <?php foreach ($dataPublisher as $key => $Pb): ?>
							    	<option value="<?php echo $Pb['id_nxb']; ?>" <?php echo ($Pb['id_nxb'] == $infoBook['id_nxb'])?'selected="selected"':""; ?> ><?php echo $Pb['TenNXB']; ?></option> 
							    <?php endforeach; ?>
						    </select>
						  </div>

						  <div class="form-group">
						    <label for="slcTypeBook">Chọn loai sach</label>
						    <select name="slcTypeBook" class="form-control"> 
						    	 <?php foreach ($dataTypeBook as $key => $typebook): ?>
							    	<option value="<?php echo $typebook['id_loai']; ?>" <?php echo ($typebook['id_loai'] == $infoBook['id_loai'])?'selected="selected"':""; ?> ><?php echo $typebook['TenLoai']; ?></option> 
							    <?php endforeach; ?>
						    </select>
						  </div>
						   <div class="form-group">
						    <label for="txtGiaCu">Giá Cũ</label>
						    <input name="txtGiaCu" type="text" class="form-control" id="txtGiaCu" placeholder="Nhập giá sách" value="<?php echo $infoBook['GiaCu']; ?>">
						  </div>
						  <div class="form-group">
						    <label for="txtGiaMoi">Giá mới</label>
						    <input name="txtGiaMoi" type="text" class="form-control" id="txtGiaMoi" placeholder="Nhập giá sách" value="<?php echo $infoBook['GiaMoi']; ?>">
						  </div>
						  <div class="form-group">
						    <label for="txtQTY">Số lượng</label>
						    <input name="txtQTY" type="text" class="form-control" id="txtQTY" placeholder="Nhập số lượng sách" value="<?php echo $infoBook['SoLuong']; ?>">
						  </div>
						  <div class="form-group">
						    <label for="txtPageBook">Số trang</label>
						    <input name="txtPageBook" type="text" class="form-control" id="txtPageBook" placeholder="Nhập số trang" value="<?php echo $infoBook['SoTrang']; ?>">
						  </div>
						  <div class="form-group">
						    <label for="txtFile">Hình Ảnh</label>
						    <input type="file" id="txtFile" name="txtFile">
						  </div>
						  <p><img width="100" height="100" src="<?php echo PATH_IMG_BOOK.$infoBook['HinhAnh']; ?>" alt=""></p>
						  <input type="hidden" name="hddBookFile" value="<?php echo $infoBook['HinhAnh']; ?>">
						  <button name="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Sửa</button>
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>