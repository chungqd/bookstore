<div class="content-wrapper right_col">
    <style type="text/css">
        .table > tbody > tr > td {
            vertical-align: middle;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <h2><?php $msg->display(); ?></h2>
                <div class="col-md-3">
                    <a href="?sk=member&m=add" title="" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Member</a>
                    <a href="?sk=member&m=index" title="" class="btn btn-primary">View All</a>
                </div>
                <div class="col-md-9">
                    <button id="btnSearch" name="btnSearch" type="button" class="btn btn-primary pull-right">Search
                    </button>
                    <input class="form-control pull-right" type="text" name="txtSearch" id="txtSearch"
                           placeholder="Enter keyword..." style="width: 300px;" value="<?php echo $keyword; ?>"/>
                </div>
                <br/><br/>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ten Dang Nhap</th>
                        <th>Ten Hien Thi</th>
                        <th>Dia Chi</th>
                        <th>SDT</th>
                        <th>Email</th>
                        <th>Trang Thai</th>
                        <th>Create Time</th>
                        <th>Update Time</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($dataMember as $key => $mb) : ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $mb['TenDangNhap']; ?></td>
                            <td><?php echo $mb['TenHienThi']; ?></td>
                            <td><?php echo $mb['DiaChi']; ?></td>
                            <td><?php echo $mb['SDT']; ?></td>
                            <td><?php echo $mb['Email']; ?></td>
                            <td><?php echo ($mb['Trang_thai'] == 1)? "Actived" : "Non-actived"; ?></td>
                            <td><?php echo $mb['create_time']; ?></td>
                            <td><?php echo $mb['update_time']; ?></td>
                            <td><a href="?sk=member&m=edit&id=<?php echo $mb['id_tk']; ?>" title=""
                                   class="btn btn-warning">Edit</a></td>
                            <td><a onclick="deleteData(<?php echo $mb['id_tk']; ?>);" title="" class="btn btn-danger">Delete</a>
                            </td>
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
    function deleteData(id) {
        if (confirm("Xoa khong?")) {
            window.location.href = "?sk=member&m=delete&id=" + id;
        }
    }

    $(document).ready(function () {
        $("#btnSearch").click(function () {
            var keyword = $.trim($("#txtSearch").val());
            window.location.href = "?sk=member&m=index&page=1&keyword=" + keyword;
        });
    });
</script>
