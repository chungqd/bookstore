<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            <h2><?php $msg->display(); ?></h2>
	            <div class="col-md-3">

	            <a href="?sk=publisher&m=add" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Publisher</a> 
	            <a href="?sk=publisher&m=index" title="" class="btn btn-primary">View All</a> 
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
							<th>Logo</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Create Time</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i=1;
					 foreach ($dataPublisher as $key => $pb): ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $pb['TenNXB']; ?></td>
							<td><img height="100" width="100" src="<?php echo PATH_IMG_PUBLISHER.$pb['logo_NXB']; ?>" alt=""></td>
							<td><?php echo $pb['SDTNXB']; ?></td>
							<td><?php echo $pb['DiaChiNXB']; ?></td>
							<td><?php echo $pb['create_time']; ?></td>
							<td><a href="?sk=publisher&m=edit&id=<?php echo $pb['id_nxb'];?>" title="" class="btn btn-primary">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
							<td><a onclick="deleteData(<?php echo $pb['id_nxb']; ?>)" title="" class="btn btn-primary">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
			window.location.href = "?sk=publisher&m=delete&id="+id;
		}
	}

	$(document).ready(function() {
		$("#btnSearch").click(function(){
			var keyword = $.trim($("#txtSearch").val());
			window.location.href = "?sk=publisher&m=index&page=1&keyword="+keyword;
		});
	});
</script>