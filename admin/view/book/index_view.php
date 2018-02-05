<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
             <h2><?php $msg->display(); ?></h2>
				<div class="col-lg-3">
					<a href="?sk=book&m=add" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Book</a>
					 <a href="?sk=book&m=index" title="" class="btn btn-primary">View All</a>  
				</div>
				<div class="col-lg-9">
					<button type="button" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
	            	<input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php echo $keyword; ?>">
				</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Tên Sách</th>
							<th>Hình Ảnh</th>
							<th>Giá Cũ</th>
							<th>Giá Mới</th>
							<th>Tác Giả</th>
							<th>Nhà Xuất Bản</th>
							<th>Loại Sách</th>
							<th>Số Lượt Xem</th>
							<th>Ngày tạo</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					 foreach ($dataBook as $key => $val): 
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $val['TenSach']; ?></td>
							<td><img height="100" width="100" src="<?php echo PATH_IMG_BOOK.$val['HinhAnh']; ?>" alt=""></td>
							<td><?php echo number_format($val['GiaCu'])." VNĐ"; ?></td>
							<td><?php echo $val['GiaMoi'] ?></td>
							<td><?php echo $val['TenTG'] ?></td>
							<td><?php echo $val['TenNXB'] ?></td>
							<td><?php echo $val['TenLoai'] ?></td>
							<td><?php echo $val['SoLuotXem'] ?></td>
							<td><?php echo $val['create_time'] ?></td>
							<td><a href="?sk=book&m=edit&id=<?php echo $val['id']; ?>" title="" class="btn btn-primary">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
							<td><a onclick="deleteBook(<?php echo $val['id']; ?>)" title="" class="btn btn-warning">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
						</tr>
					<?php $i++;  endforeach; ?>
					</tbody>
				</table>
				<?php echo $dataPaging['html']; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function deleteBook(id){
		if (confirm("Bạn có muốn xóa không")) {
			window.location.href = "?sk=book&m=delete&id="+id;
		}
	}

	$(document).ready(function() {
		$("#btnSearch").click(function(){
			var keyword = $.trim($("#txtSearch").val());
			window.location.href = "?sk=book&m=index&page=1&keyword="+keyword;
		});
	});
</script>