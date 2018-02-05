<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <h2 class="text-center">Danh sách chi tiết đơn hàng !!!</h2>
                <h2><?php $msg->display(); ?></h2>
                <div class="col-md-3">

<!--                    <a href="?sk=publisher&m=add" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Publisher</a>-->
                    <a href="?sk=detail_order&m=index" title="" class="btn btn-primary">View All</a>
                </div>
                <div class="col-md-9">
                    <button type="button" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
                    <input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php echo $keyword; ?>">
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên KH</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Tên sách</th>
                       <!--  <th>Hình ảnh</th> -->
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach ($dataOrder as $key => $ord): ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $ord['TenKH']; ?></td>
                            <td><?php echo $ord['SDT']; ?></td>
                            <td><?php echo $ord['Email']; ?></td>
                            <td><?php echo $ord['DiaChi']; ?></td>
                            <td><?php echo $ord['TenSach']; ?></td>
                            <!-- <td><img width="60" height="60" src="<?php //echo PATH_IMG_BOOK . $ord['HinhAnh']; ?>" alt=""></td> -->
                            <td><?php echo $ord['SoLuong']; ?></td>
                            <td><?php echo $ord['ThanhTien']; ?></td>
                            <td class="success">Da thanh toan</td>
                            <td><a href="?sk=detail_order&m=export&id=<?php echo $ord['id_hoadon']; ?>" class="btn btn-info">Xuất hóa đơn <i class="fa fa-file-text" aria-hidden="true"></i></a></td>
                            <td><a onclick="deleteData(<?php echo $ord['id_hoadon']; ?>)" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
            window.location.href = "?sk=detail_order&m=delete&id="+id;
        }
    }

    $(document).ready(function() {
        $("#btnSearch").click(function(){
            var keyword = $.trim($("#txtSearch").val());
            window.location.href = "?sk=detail_order&m=index&page=1&keyword="+keyword;
        });
    });
</script>