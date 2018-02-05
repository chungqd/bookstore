<?php
    require_once '../model/Member_mode.php';
    $method = isset($_GET['m']) ? $_GET['m'] : 'index';
    switch ($method)
    {
        case 'index':
            listAllMemBer();
            break;
        case 'delete':
            deleteMember();
            break;
        case 'edit':
            editMember();
            break;
        default:
            listAllMember();
            break;
    }

    function listAllMember()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

        // lay du lieu de hien thi ra bang du lieu
        $dataMb = getAllDataMember($keyword);
        $link = createLink(BASE_URL, array('sk'=>'member', 'm'=>'index', 'page'=>'{page}', 'keyword'=>$keyword));
        $dataPaging = paging($link,count($dataMb),$page,ROW_LIMIT,$keyword);
        $dataMember = getDataMemberByPage($dataPaging['start'], $dataPaging['limit'], $dataPaging['keyword']);
        require_once '../view/member/index_view.php';
    }

    function editMember()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $id = is_numeric($id) ? $id : "";
        $infoMember = getInfoDataMember_model($id);
        if (empty($infoMember)) {
            require_once '../view/notfound_view.php';
        }else{
            if (isset($_POST['btnSubmit'])) {
                $status = isset($_POST['slcStatus']) ? $_POST['slcStatus'] : '';
                $status = is_numeric($status) ? $status : "";
                $edit = updateInfoData_model($status, $id);
                if ($edit) {
                    $msg->success("Sua thanh cong");
                    header("Location: ?sk=member");
                }else{
                    $msg->error("Sua that bai");
                    header("Location: ?sk=member");
                }
            }
        }
        require_once '../view/member/editMember_view.php';
    }

    function deleteMember()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $id = isset($_GET['id']) ? $_GET['id'] : "";
        $id = is_numeric($id) ? $id : 0;
        $dataInfo = getDataInfoMember($id);
        if (empty($dataInfo)) {
            require_once '../view/notfound_view.php';
        } else {
            $delete = deleteDataMember($id);
            if ($delete) {
                $msg->success("Xoa thanh cong");
                header("Location: ?sk=member");
            } else {
                $msg->error("Xoa that bai");
                header("Location: ?sk=member");
            }
        }

    }