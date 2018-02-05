<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            <h2><?php $msg->display(); ?></h2>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Edit Typebook</h2>
					<a href="?sk=typebook" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
						<form action="?sk=typebook&m=edit&id=<?php echo $dataInfo['id_loai']; ?>" method="post" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="txtName">Tên Loại Sách</label>
						    <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Tên loại sách" value="<?php echo $dataInfo['TenLoai']; ?>">
						    <input type="hidden" name="hddNameTB" value="<?php echo $dataInfo['TenLoai']; ?>">
						  </div>
						  <button name="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Sửa</button>
						</form>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>