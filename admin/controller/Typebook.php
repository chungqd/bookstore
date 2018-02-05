<?php  
    require '../model/Typebook_model.php';
    $method = isset($_GET['m'])?$_GET['m']:'index';
    switch ($method) {
        case 'index':
            listAllType();
            break;
        case 'add':
            addTypeBook();
            break;
        case 'edit':
            editTypeBook();
            break;
        case 'delete':
            deleteTypeBook();
            break;
        default:
            // code...
            break;
    }

/**
 *
 */
function listAllType()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $page = isset($_GET['page'])?$_GET['page']:1;
        $keyword = isset($_GET['keyword'])?$_GET['keyword']:"";
        $dataTB = getAllDataTypeBook($keyword);
        // print_r($dataTB);
        // die();
        $link = createLink(BASE_URL, array("sk"=>"typebook", "m"=>"index", "page"=>'{page}', "keyword"=>$keyword));
        $dataPaging = paging($link, count($dataTB), $page, ROW_LIMIT, $keyword);
        $dataTypeBook = getDataTypeBookByPage($dataPaging['start'], $dataPaging['limit'], $dataPaging['keyword']);

        require_once '../view/typebook/index_view.php';
    }

    function deleteTypeBook()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $idTb = isset($_GET['id'])?$_GET['id']:0;
        $idTb = is_numeric($idTb)?$idTb:0;
        $dataInfo = getDataInfoTypeBook($idTb);
        if (empty($dataInfo)) {
            require_once '../view/notfound_view.php';
        } else {
            $delete = deleteTypeBook_model($idTb);
            if ($delete) {
                $msg->success('Xoa thanh cong');
                header("Location: ?sk=typebook");
            } else {
                $msg->error('Xoa that bai');
                header("Location: ?sk=typebook");
            }
        }
    }

/**
 *
 */
function addTypeBook()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        require_once '../view/typebook/addTypebook_view.php';
        if (isset($_POST['btnSubmit'])) {
            $typeName = isset($_POST['txtName'])?$_POST['txtName']:'';
            $typeName = strip_tags($typeName);

            $check = validate_data($typeName);
            $flag = true;
            if (!empty($check)) {
                $flag = false;
            }

            if ($flag) 
            {
                $checkType = checkTypeBook($typeName);
                if ($checkType) 
                {
                    $add = addInfoTypeBook_model($typeName);
                    if ($add) 
                    {
                        $msg->success("Them thanh cong");
                        header("Location: home.php?sk=typebook&m=index");
                    } else 
                    {
                        $msg->error("Them that bai");
                    }
                } else 
                {
                    $msg->error("Trung nha xuat ban");
                }
            } else 
            {
                $msg->error("Du lieu nhap sai");
            }

        }
    }

    function validate_data($name)
    {
        return (empty($name) OR strlen($name)<3)? "Ten ko hop le": "";
    }
    function editTypeBook()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $idTb = isset($_GET['id'])?$_GET['id']:0;
        $dataInfo = getDataInfoTypeBook($idTb);

        if (empty($dataInfo)) {
            require_once '../view/notfound_view.php';
        } else {
            require_once '../view/typebook/editTypebook_view.php';
            if (isset($_POST['btnSubmit'])) {
                $name = isset($_POST['txtName'])?$_POST['txtName']: '';
                $name = strip_tags($name);

                $checkTB = isset($_POST['hddNameTB'])?$_POST['hddNameTB']:'';
                $checkTB = strip_tags($checkTB);
                $check = validate_data($name);
                $flag = true;
                if (!empty($check))
                {
                    $flag = false;
                }
                if ($flag) {
                    $checkName = true;
                    if ($name !== $checkTB) {
                        $checkName = checkTypeBook($name);
                    }

                    if ($checkName) 
                    {
                        $edit = editDataInfoTypeBook($idTb, $name);
                        if ($edit) {
                            $msg->success("Sửa thành công");
                            header("Location: ?sk=typebook");
                        } else {
                            $msg->error("Sửa thất bại");
                            header("Location: ?sk=typebook&m=edit&id={$idTb}");
                        }
                    } else {
                        $msg->error("Trùng nhà xuât bản");
                        header("Location: ?sk=typebook&m=edit&id={$idTb}");
                    }
                } else {
                    $msg->error("Dữ liệu nhập sai");
                    header("Location: ?sk=typebook&m=edit&id={$idTb}");
                }
            }  
        }
    }
?>
