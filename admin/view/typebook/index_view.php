<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            <h2><?php $msg->display(); ?></h2>
	            <div class="col-md-3">

	            <a href="?sk=typebook&m=add" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add TypeBook</a> 
	            <a href="?sk=typebook&m=index" title="" class="btn btn-primary">View All</a> 
	            </div>
	            <div class="col-md-9">
	            	<button type="button" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
	            	<input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php echo $keyword; ?>">
	            </div>         
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Create Time</th>
							<th>Update Time</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i=1;
					 foreach ($dataTypeBook as $key => $tb): ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $tb['TenLoai']; ?></td>
							<td><?php echo $tb['create_time']; ?></td>
							<td><?php echo $tb['update_time']; ?></td>
							<td><a href="?sk=typebook&m=edit&id=<?php echo $tb['id_loai'];?>" title="" class="btn btn-warning">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
							<td><a onclick="deleteData(<?php echo $tb['id_loai']; ?>)" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
						</tr>
					<?php $i++; endforeach; ?>
					</tbody>
				</table>
				<?php echo $dataPaging['html']; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function deleteData(id){
		if (confirm("Bạn có muốn xóa không")) {
			window.location.href = "?sk=typebook&m=delete&id="+id;
		}
	}

	$(document).ready(function() {
		$("#btnSearch").click(function(){
			var keyword = $.trim($("#txtSearch").val());
			window.location.href = "?sk=typebook&m=index&page=1&keyword="+keyword;
		});
	});
</script>