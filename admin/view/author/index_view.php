
<div class="content-wrapper right_col">
<style type="text/css">
.table > tbody > tr > td {
  vertical-align: middle;
}
</style>
  <div class="row">
    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="main-content">
        <h2><?php $msg->display(); ?></h2>
        <div class="col-md-3">
          <a href="?sk=author&m=add" title="" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;Add Author</a>
          <a href="?sk=author&m=index" title="" class="btn btn-primary">&nbsp;&nbsp;View All</a>
        </div>
        <div class="col-md-9">
          <button id="btnSearch" name="btnSearch" type="button" class="btn btn-primary pull-right">Search</button>
          <input class="form-control pull-right" type="text" name="txtSearch" id="txtSearch" placeholder="Enter keyword..." style="width: 300px;" value="<?php echo $keyword; ?>" />
        </div>
        <br /><br />
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Logo</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Create Time</th>
              <th>Năm sinh</th>
              <th class="text-center" colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php $i = 1; ?>
          <?php foreach ($dataAuthor as $key => $au) : ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $au['TenTG']; ?></td>
              <td>
                <img width="120" height="120" src="<?php echo PATH_IMG_AUTHOR . $au['img_path']; ?>" alt="">
              </td>
              <td><?php echo $au['SDTTG']; ?></td>
              <td><?php echo $au['DiaChiTG']; ?></td>
              <td><?php echo $au['create_time']; ?></td>
              <td><?php echo $au['namsinh']; ?></td>
              <td><a href="?sk=author&m=edit&id=<?php echo $au['id_tg']; ?>" title="" class="btn btn-warning">Edit</a></td>
              <td><a onclick="deleteData(<?php echo $au['id_tg']; ?>);" title="" class="btn btn-danger">Delete</a></td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php echo $dataPaging['html']; ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
  function deleteData(id){
    if(confirm("Xoa khong?")){
      window.location.href = "?sk=author&m=delete&id="+id;
    }
  }

  $(document).ready(function() {
    $("#btnSearch").click(function() {
      var keyword = $.trim($("#txtSearch").val());
      window.location.href = "?sk=author&m=index&page=1&keyword="+keyword;
    });
  });
</script>
