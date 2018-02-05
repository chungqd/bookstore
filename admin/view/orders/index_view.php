<div class="content-wrapper right_col">
<style type="text/css" media="screen">
  th, td {
    border-bottom: 1px solid #ddd;
}
</style>
  <div class="row">
    <h2 class="text-center">Danh sách đơn hàng !!!</h2>
  </div>
  <div class="row">
  <?php foreach ($dataOrders as $k => $b): ?>
    <div class="col-md-12" style="border-bottom: 2px dotted green ; margin: 20px 0px;background-color: #CCFFFF;">
      <div class="col-md-2">
        <p>
          <img width="100%" height="250px;" src="<?php echo PATH_IMG_BOOK . $b['imgBook'];  ?>" alt="">
        </p>
        <h3 class="text-center"><?php echo $b['nameBook']; ?></h3>
      </div>
      <div class="col-md-10" style="background-color: white;">
        <div class="table-responsive">
          <table class="table table-bordered" style="margin-top: 10px;">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Qty</th>
                <th>Money</th>
                <th>Create</th>
                <th>Note</th>
                <th colspan="2" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
          <?php if (isset($b['ltsOrder'])): ?>
              <?php $i = 1; ?>
            <?php foreach ($b['ltsOrder'] as $key => $val): ?>
             <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $val['TenKH']; ?></td>
                <td><?php echo $val['SDT']; ?></td>
                <td><?php echo $val['Email']; ?></td>
                <td><?php echo $val['DiaChi']; ?></td>
                <td><?php echo $val['SoLuong']; ?></td>
                <td><?php echo number_format($val['ThanhTien']); ?></td>
                <td><?php echo $val['create_time']; ?></td>
                <td><?php echo $val['GhiChu']; ?></td>
              <?php if ($val['TrangThai'] != 1): ?>
                <td><button onclick="updateOrdres(<?php echo $val['id_hd']; ?>,1);" type="button" class="btn btn-small btn-primary">Xác nhận</button></td>
                <td><button onclick="updateOrdres(<?php echo $val['id_hd']; ?>,2);" type="button" class="btn btn-small btn-danger"> Hủy</button></td>
              <?php endif ?>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
          <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endforeach; ?>  
  </div>
</div>
<script type="text/javascript">
  function updateOrdres(id, type){
    $.ajax({
      url: '?sk=orders&m=update',
      type:'POST',
      data:{id:id, type:type},
      success: function(data){
        data = $.trim(data);
        if (data == 'ok') {
          alert("Thao tac thanh cong");
          window.location.reload(true);
        }
        else if (data == 'err') {
          alert('co loi xay ra');
          window.location.reload(true);
        }
        else if (data == 'errup') {
          alert('Xac nhan Tb');
          window.location.reload(true);
        }
        else if (data == 'errqty') {
          alert('Khong du sach ban');
          window.location.reload(true);
        }
        else if (data == 'errde') {
          alert('Xoa don hang tb');
          window.location.reload(true);
        }
      }
    });
  }
</script>