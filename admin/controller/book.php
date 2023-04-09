    <?php
        require_once "../model/books_model.php";

        $method = isset($_GET['m'])?$_GET['m']:'index';
        switch ($method) {
            case 'index':
                listAllBooks();
                break;
            case 'add':
                addBooks();
                break;
            case 'edit':
                editBooks();
                break;
            case 'delete':
                deleteBook();
                break;
            default:
                listAllBooks();
                break;
        }

        function listAllBooks(){
            // lay all data tac gia
            $msg = new \Plasticbrain\FlashMessages\FlashMessages();
            if (isset($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }
            $page = isset($_GET['page'])?$_GET['page']:1;

            $keyword = isset($_GET['keyword'])?$_GET['keyword']:"";
            // get all data dung de dem so luong sach
            $allDataBook = get_all_data_book_model($keyword);

            $link = createLink(BASE_URL, array("sk"=>"book","m"=>"index","page"=>'{page}', "keyword"=>$keyword));
            $dataPaging = paging($link, count($allDataBook), $page, ROW_LIMIT, $keyword);
            $dataBook = getDataBookByPage_model($dataPaging['start'], $dataPaging['limit'], $dataPaging['keyword']);
            require_once "../view/book/index_view.php";
        }

        function addBooks(){
            $msg = new \Plasticbrain\FlashMessages\FlashMessages();
            $dataAuthor = get_all_data_author_model();
            $dataPublisher = get_all_data_publisher_model();
            $dataTypeBook = get_all_data_typebook_model();
            require_once "../view/book/addBook_view.php";
            if (isset($_POST['btnSubmit1'])) {
                $nameBook = isset($_POST['txtNameBook'])?trim($_POST['txtNameBook']):'';
                $nameBook = strip_tags($nameBook);
                $author = isset($_POST['slcAuthor'])?$_POST['slcAuthor']:""; // lay id tac gia
                $author = is_numeric($author)?$author:'';
                $Publisher = isset($_POST['slcPublisher'])?$_POST['slcPublisher']:"";
                $Publisher = is_numeric($Publisher)?$Publisher:'';
                $TypeBook = isset($_POST['slcTypeBook'])?$_POST['slcTypeBook']:"";
                $TypeBook = is_numeric($TypeBook)?$TypeBook:'';
                $GiaSach = isset($_POST['txtGia'])?trim($_POST['txtGia']):"";
                $GiaSach = strip_tags($GiaSach);
                $soluong = isset($_POST['txtQTY'])?trim($_POST['txtQTY']):"";
                $soluong = strip_tags($soluong);
                $sotrang = isset($_POST['txtPageBook'])?trim($_POST['txtPageBook']):"";
                $sotrang = strip_tags($sotrang);
                $hinhanh = "";
                $type = 2;
                if (isset($_FILES['txtFile'])) {
                    $hinhanh = uploadFiles($_FILES, $type);
                }
                $flag1 = TRUE;
                $check = validate_data($nameBook, $GiaSach, $soluong, $sotrang, $hinhanh);
                foreach ($check as $key => $value) {
                    if (!empty($value)) {
                        $flag1 = FALSE;
                        break;
                    }
                }

                if ($flag1) {
                    $checkname = check_name_book($nameBook);
                    if ($checkname)
                    {
                        $add = add_book_model($nameBook,$Publisher,$author,$hinhanh,$GiaSach,$TypeBook,$soluong,$sotrang);
                        if ($add)
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $msg->success('Thêm thành công');
                            header("Location: home.php?sk=book&m=index");
                        }
                        else
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $msg->error('Thêm thất bại');
                            header("Location: home.php?sk=book&m=add");
                        }
                    }
                    else
                    {
                        $msg->error('Tên sách đã có');
                        header("Location: home.php?sk=book&m=add");
                    }
                }
                else{
                $msg->error('Dữ liệu nhập sai');
                $_SESSION['error'] = $check;
                header("Location: home.php?sk=book&m=add");
                }
            }
        }

        // ham Check thong tin nhap vao
        function validate_data($nameBook, $giasach, $soluong, $sotrang, $hinhanh){
            $errors = array();
            $errors['nameBook'] = (empty($nameBook) OR strlen($nameBook)<3)?"Tên sách còn trống hoặc phải lớn hơn 3 kí tự":"";
            $errors['giasach'] = empty($giasach)? "Vui lòng thêm giá sách":"";
            $errors['soluong'] = empty($soluong)?"Vui lòng nhập số lượng":"";
            $errors['sotrang'] = empty($sotrang)?"Vui lòng nhập số trang":"";
            $errors['hinhanh'] = empty($hinhanh)?"Vui lòng nhập hình ảnh":"";
            return $errors;
        }

        function check_name_book($name){
            $checkNameBook = check_name_book_model($name);
            return $checkNameBook;
        }

        // Ham Sua
        function editBooks(){
            $msg = new \Plasticbrain\FlashMessages\FlashMessages();
            $dataAuthor = get_all_data_author_model();
            $dataPublisher = get_all_data_publisher_model();
            $dataTypeBook = get_all_data_typebook_model();
            $idb = isset($_GET['id'])?$_GET['id']:0;
            $idb = is_numeric($idb)?$idb:"";
            $infoBook = get_info_data_book_model($idb);
            if (empty($infoBook)) {
                require_once "../view/notfound_view.php";
            }
            else
            {
                if (isset($_POST['btnSubmit']))
                {
                    $nameBook = isset($_POST['txtNameBook'])?$_POST['txtNameBook']:'';
                    $nameBook = strip_tags($nameBook);
                    $hddNameBook = isset($_POST['txthddNameBook'])?$_POST['txtNameBook']:'';
                    $hddNameBook = strip_tags($hddNameBook);

                    $author = isset($_POST['slcAuthor'])?$_POST['slcAuthor']:""; // lay id tac gia
                    $author = is_numeric($author)?$author:'';

                    $Publisher = isset($_POST['slcPublisher'])?$_POST['slcPublisher']:"";
                    $Publisher = is_numeric($Publisher)?$Publisher:'';
                    $TypeBook = isset($_POST['slcTypeBook'])?$_POST['slcTypeBook']:"";
                    $TypeBook = is_numeric($TypeBook)?$TypeBook:'';
                    $GiaCu = isset($_POST['txtGiaCu'])?trim($_POST['txtGiaCu']):"";
                    $GiaCu = strip_tags($GiaCu);
                    $GiaMoi = isset($_POST['txtGiaMoi'])?trim($_POST['txtGiaMoi']):"";
                    $GiaMoi = strip_tags($GiaMoi);
                    $soluong = isset($_POST['txtQTY'])?trim($_POST['txtQTY']):"";
                    // them trạng thai
                    $soluong = strip_tags($soluong);
                    $sotrang = isset($_POST['txtPageBook'])?trim($_POST['txtPageBook']):"";
                    $sotrang = strip_tags($sotrang);

                    // xu ly anh
                    $hinhanh = "";
                    $hddImg = isset($_POST['hddBookFile'])?$_POST['hddBookFile']:'';

                    $type = 2;
                    // case up anh moi
                    if (isset($_FILES['txtFile']))
                    {
                        $hinhanh = uploadFiles($_FILES,$type);
                    }
                    // case ko up anh moi de anh cu
                    $Img = (empty($hinhanh))?$hddImg:$hinhanh;
                    $flag = TRUE;
                    $check = validate_data($nameBook, $GiaCu, $soluong, $sotrang, $Img);
                    foreach ($check as $key => $value) {
                        if (!empty($value)) {
                            $flag = FALSE;
                            break;
                        }
                    }
                    if ($flag) {
                        $checkFlag = TRUE;
                        if ($nameBook!==$hddNameBook) {
                            $checkFlag = check_name_book($nameBook);
                        }
                        if ($checkFlag)
                        {
                            $edit = update_info_data_model($idb,$nameBook, $author, $Publisher, $TypeBook, $GiaCu, $GiaMoi, $soluong, $sotrang, $Img);
                            if ($edit)
                            {
                                if (isset($_SESSION['error']))
                                {
                                    unset($_SESSION['error']);
                                }
                                $msg->success('Sửa thành công');
                                header("Location: home.php?sk=book&m=index");
                            }
                            else
                            {
                                if (isset($_SESSION['error']))
                                {
                                    unset($_SESSION['error']);
                                }
                                $msg->error('Sửa thất bại');
                                header("Location: home.php?sk=book&m=edit&id={$idb}");
                            }
                        }
                        else
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $msg->error('Tên sách đã có');
                            header("Location: home.php?sk=book&m=edit&id={$idb}");
                        }
                    }
                    else
                    {
                        $msg->error('Dữ liệu nhập sai');
                        $_SESSION['error'] = $check;
                        header("Location: home.php?sk=book&m=edit&id={$idb}");
                    }

                }
            }
            require_once "../view/book/editBook_view.php";
        }

        // Hàm xóa sách chú ý xóa href ở thẻ a chỗ onclick
        function deleteBook(){
            $msg = new \Plasticbrain\FlashMessages\FlashMessages();
            $id = isset($_GET['id'])?$_GET['id']:0;
            $id = is_numeric($id)?$id:0;
            $dataById = get_info_data_book_model($id);
            if (empty($dataById)) {
                require_once "../view/notfound_view.php";
            }
            else
            {
                $delete = delete_book_model($id);
                if ($delete) {
                    $msg->success('Xóa thành công');
                    header("Location: ?sk=book");
                }
                else
                {
                    $msg->error('Xóa thất bại');
                    header("Location: ?sk=book");
                }
            }

        }
?>