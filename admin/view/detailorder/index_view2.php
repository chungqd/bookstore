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
                                <th>Tên KH</th>
                                <th>SĐT</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Tên sách</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th>
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
                                        <td><?php echo $val['TenSach']; ?></td>
                                        <td><?php echo $val['SoLuong']; ?></td>
                                        <td><?php echo number_format($val['ThanhTien']); ?></td>
                                        <td><?php echo $val['TrangThai']; ?></td>

                                        <td><a onclick="deleteData(<?php echo $pb['id_nxb']; ?>)" title="" class="btn btn-primary">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
