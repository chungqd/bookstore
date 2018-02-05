<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center">Edit Book</h2>
                        <h2><?php $msg->display(); ?></h2>
                        <a href="?sk=member" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                        <form action="?sk=member&m=edit&id=<?php echo $infoMember['id_tk']; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="slcStatus">Trang thai</label>
                                <select name="slcStatus" class="form-control">
                                        <option value="1" <?php echo ($infoMember['Trang_thai'] == 1)? 'selected="selected"':"";?>>Actived</option>
                                        <option value="0" <?php echo ($infoMember['Trang_thai'] == 0)? 'selected="selected"':"";?>>Block</option>
                                </select>
                            </div>
                            <button name="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Sửa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>