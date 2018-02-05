<?php  
    require_once '../model/Author_model.php';

    $method = isset($_GET['m']) ? $_GET['m']: 'index';
    switch ($method) {
        case 'index':
            listAllAuthor();
            break;
        case 'add':
            addAuthor();
            break;
        case 'edit':
            editAuthor();
            break;
        case 'delete':
            deleteAuthor();
            break;
        default:
            listAllAuthor();
            break;
    }

    function listAllAuthor()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $page = isset($_GET['page'])? $_GET['page'] : 1;
        $keyword = isset($_GET['keyword'])? $_GET['keyword'] : "";

        // lay du lieu de hien thi ra bang du lieu
        $dataAu = getAllDataAuthor($keyword);
        $link = createLink(BASE_URL, array("sk"=>"author", "m"=>"index", "page"=>'{page}', "keyword"=>$keyword));
        $dataPaging = paging($link, count($dataAu), $page, ROW_LIMIT, $keyword);
        $dataAuthor = getDataAuthorByPage($dataPaging['start'], $dataPaging['limit'], $dataPaging['keyword']);
        require_once '../view/author/index_view.php';
    }

    function addAuthor()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        require_once '../view/author/addAuthor_view.php';
        if (isset($_POST['btnSubmit']))
        {
            $name = isset($_POST['txtName']) ? $_POST['txtName'] : '';
            $name = strip_tags($name);

            $phone = isset($_POST['txtPhone']) ? $_POST['txtPhone'] : '';
            $phone = strip_tags($phone);

            $address = isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
            $address = strip_tags($address);

            $img = "";
            $type = 3;
            if (isset($_FILES['txtFile'])) {
                $img = uploadFiles($_FILES, $type);
            }

            $check = validate_data($name, $phone, $address, $img);
            $flag = true;
            foreach ($check as $key => $value) {
                if (!empty($value)) {
                    $flag = false;
                    break;
                }
            }

            if ($flag) {
                $checkAu = checkExistNameAuthor($name);
                if ($checkAu)
                {
                    $add = addInfoAuthor_model($name, $phone,$address,$img);
                    if ($add)
                    {
                        $msg->success("Them thanh cong");
                        header("Location: home.php?sk=author&m=index");
                    } else
                    {
                        $msg->error("Loi them tac gia");
                    }
                } else
                {
                    $msg->error("Ten tac gia da ton tai") ;
                    header("Location: home.php?sk=author&m=add");
                }
            } else
            {
                foreach ($check as $key => $value)
                    if (!empty($value))
                    {
                        $msg->error($value);
                    }
            }
        }
    }

    function editAuthor()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $id = isset($_GET['id'])?$_GET['id']:0;
        $dataInfo = getDataInfoAuthor($id);
        if (empty($dataInfo))
        {
            require_once '../view/notfound_view.php';
        }else
        {
            require_once '../view/author/editAuthor_view.php';
        }

        if(isset($_POST['btnSubmit']))
        {
            $name = isset($_POST['txtName']) ? $_POST['txtName'] : '';
            $name = strip_tags($name);
            $hddName = isset($_POST['hddNameAu']) ? $_POST['hddNameAu'] : '';
            $hddName = strip_tags($hddName);
            $phone = isset($_POST['txtPhone']) ? $_POST['txtPhone'] : '';
            $phone = strip_tags($phone);
            $address = isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
            $address = strip_tags($address);
            $hddImg = isset($_POST['hddFile']) ? $_POST['hddFile']: '';
            $hddImg = strip_tags($hddImg);

            $img = "";
            $type = 3;

            if (isset($_FILES['txtFile']))
            {
                $img = uploadFiles($_FILES, $type);
            }
            $imgAu = (empty($img)) ? $hddImg : $img;
            $check = validate_data($name, $phone, $address, $imgAu);
            $flag = true;
            foreach ($check as $key => $value)
            {
                if (!empty($value))
                {
                    $flag = false;
                    break;
                }
            }

            if ($flag)
            {
                $checkNameAu = true;
                if ($name !== $hddName)
                {
                    $checkNameAu = checkExistNameAuthor($name);
                }
                if($checkNameAu)
                {
                    $update = updateDataAuthor_model($name, $phone, $address, $imgAu, $id);
//                    var_dump($imgAu); die();
                    if ($update)
                    {
                        $msg->success("Sua thanh cong");
                        header("Location: ?sk=author");
                    }else{
                        $msg->error("Sua that bai");
                        header("Location: ?sk=author&m=edit&id={$id}");
                    }
                }else{
                    $msg->warning("Ten tac gia da ton tai");
                    header("Location: ?sk=author&m=edit&id={$id}");
                }
            }else{
                foreach ($check as $key => $value)
                {
                    $msg->error($value);
                    header("Location: ?sk=author&m=edit&id={$id}");
                }
                
            }
        }
    }

    function validate_data($name, $phone, $address, $img){
        $errors = array();
        $errors['name'] = (empty($name) OR strlen($name) < 3) ? "name không         được để trống và lớn hơn 3 kí tự" : "";
        $errors['phone']    = (empty($phone)) ? "Phone không được để trống" : "";
        $errors['add']  = (empty($address)) ? "Address không được để trống" : "";
        $errors['logo'] = (empty($img)) ? "Logo không được để trống" : "";

        return $errors;
    }

    function deleteAuthor()
    {
        $msg  = new \Plasticbrain\FlashMessages\FlashMessages();
        $id = isset($_GET['id'])?$_GET['id'] : '';
        $id = is_numeric($id)?$id:0;
        $dataInfo = getDataInfoAuthor($id);
        if (empty($dataInfo)) {
            require_once '../view/notfound_view.php';
        } else {
            $delete = deleteDataAuthor($id);
            if ($delete) {
                $msg->success("Xoa thanh cong");
                header("Location: ?sk=author");
            } else {
                $msg->error("Xoa that bai");
                header("Location: ?sk=author");
            }
        }
    }
?>