<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <h3><?php $msg->display(); ?></h3>
                <h2 class="text-center">EDIT Author</h2>
                <a href="?sk=author" title="" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i> &nbsp;&nbsp;Comeback</a>
                <br /> <br />
                <form action="?sk=author&m=edit&id=<?php echo $dataInfo['id_tg']; ?>" method="POST" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="txtName">Name Author</label>
                        <input type="text" class="form-control" id="txtName" placeholder="Name..." name="txtName" value="<?php echo $dataInfo['TenTG']; ?>">
                        <input type="hidden" name="hddNameAu" value="<?php echo $dataInfo['TenTG']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtPhone">Phone Number</label>
                        <input type="text" class="form-control" id="txtPhone" placeholder="Phone..." name="txtPhone" value="<?php echo $dataInfo['SDTTG']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtAddress">Address</label>
                        <input type="text" class="form-control" id="txtAddress" placeholder="Address..." name="txtAddress" value="<?php echo $dataInfo['DiaChiTG']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Choose logo</label>
                        <input type="file" id="txtFile" name="txtFile">
                        <input type="hidden" name="hddFile" value="<?php echo $dataInfo['img_path']; ?>">
                        <br/>
                        <img src="<?php echo PATH_IMG_AUTHOR . $dataInfo['img_path']; ?>" alt="" width="150" height="150">
                    </div>
                    <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>