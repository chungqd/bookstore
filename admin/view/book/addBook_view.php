<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
           <div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Add Book</h2>
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
						<form action="?sk=book&m=add" method="post" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="txtNameBook">Tên Sách</label>
						    <input type="text" class="form-control" name="txtNameBook" id="txtNameBook" placeholder="Tên Sách">
						  </div>
						  <div class="form-group">
						    <label for="slcAuthor">Chọn tác giả</label>
						    <select name="slcAuthor" class="form-control"> 
							    <?php foreach ($dataAuthor as $key => $au): ?>
							    	<option value="<?php echo $au['id_tg']; ?>"><?php echo $au['TenTG']; ?></option> 
							    <?php endforeach; ?>
						    </select>
						  </div>
						  
						  <div class="form-group">
						    <label for="slcPublisher">Chọn nhà xuất bản</label>
						    <select name="slcPublisher" class="form-control"> 
						    	 <?php foreach ($dataPublisher as $key => $Pb): ?>
							    	<option value="<?php echo $Pb['id_nxb']; ?>"><?php echo $Pb['TenNXB']; ?></option> 
							    <?php endforeach; ?>
						    </select>
						  </div>

						  <div class="form-group">
						    <label for="slcTypeBook">Chọn loai sach</label>
						    <select name="slcTypeBook" class="form-control"> 
						    	 <?php foreach ($dataTypeBook as $key => $typebook): ?>
							    	<option value="<?php echo $typebook['id_loai']; ?>"><?php echo $typebook['TenLoai']; ?></option> 
							    <?php endforeach; ?>
						    </select>
						  </div>
						   <div class="form-group">
						    <label for="txtGia">Giá sách</label>
						    <input name="txtGia" type="text" class="form-control" id="txtGia" placeholder="Nhập giá sách">
						  </div>
						  <div class="form-group">
						    <label for="txtQTY">Số lượng</label>
						    <input name="txtQTY" type="text" class="form-control" id="txtQTY" placeholder="Nhập số lượng sách">
						  </div>
						  <div class="form-group">
						    <label for="txtPageBook">Số trang</label>
						    <input name="txtPageBook" type="text" class="form-control" id="txtPageBook" placeholder="Nhập số trang">
						  </div>
						  <div class="form-group">
						    <label for="txtFile">Hình Ảnh</label>
						    <input type="file" id="txtFile" name="txtFile">
						  </div>
						  <button name="btnSubmit1" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Thêm</button>
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>