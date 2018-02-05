<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            <h2><?php $msg->display(); ?></h2>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Add TypeBook</h2>
					<a href="?sk=typebook" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
						<form action="?sk=typebook&m=add" method="post" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="txtName">Tên loại sách</label>
						    <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Tên loại sách">
						  </div>
						  <button name="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Thêm</button>
						</form>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>