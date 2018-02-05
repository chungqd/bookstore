<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            <h2><?php //$msg->display(); ?></h2>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Edit Publisher</h2>
					<a href="?sk=publisher" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
						<form action="?sk=publisher&m=edit&id=<?php echo $dataInfo['id_nxb']; ?>" method="post" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="txtName">Tên NXB</label>
						    <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Tên NXB" value="<?php echo $dataInfo['TenNXB']; ?>">
						    <input type="hidden" name="hddNamPB" value="<?php echo $dataInfo['TenNXB']; ?>">
						  </div>
						  <div class="form-group">
						    <label for="txtPhone">Số điện thoại NXB</label>
						    <input name="txtPhone" type="text" class="form-control" id="txtPhone" placeholder="Số điện thoại NXB" value="<?php echo $dataInfo['SDTNXB']; ?>">
						  </div>
						   <div class="form-group">
						    <label for="txtAddress">Địa chỉ NXB</label>
						    <input name="txtAddress" type="text" class="form-control" id="txtAddress" value="<?php echo $dataInfo['DiaChiNXB']; ?>" placeholder="Địa chỉ NXB">
						  </div>
						  
						  <div class="form-group">
						  <input type="hidden" name="hddFile" value="<?php echo $dataInfo['logo_NXB']; ?>">
						  <img height="100" width="100" src="<?php echo PATH_IMG_PUBLISHER.$dataInfo['logo_NXB']; ?>" alt="">
						    <label for="txtFile">Logo NXB</label>
						    <input type="file" id="txtFile" name="txtFile">
						  </div>
						  <button name="btnSubmi" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Sửa</button>
						</form>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>