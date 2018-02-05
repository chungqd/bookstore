<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            <h2><?php $msg->display(); ?></h2>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Add Publisher</h2>
					<a href="?sk=publisher" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
						<form action="?sk=publisher&m=add" method="post" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="txtName">Tên NXB</label>
						    <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Tên NXB">
						  </div>
						  <div class="form-group">
						    <label for="txtPhone">Số điện thoại NXB</label>
						    <input name="txtPhone" type="text" class="form-control" id="txtPhone" placeholder="Số điện thoại NXB">
						  </div>
						   <div class="form-group">
						    <label for="txtAddress">Địa chỉ NXB</label>
						    <input name="txtAddress" type="text" class="form-control" id="txtAddress" placeholder="Địa chỉ NXB">
						  </div>
						  <div class="form-group">
						    <label for="txtFile">Logo NXB</label>
						    <input type="file" id="txtFile" name="txtFile">
						  </div>
						  <button name="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Thêm</button>
						</form>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>