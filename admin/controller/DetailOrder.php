<?php
    /**
     * Created by PhpStorm.
     * User: CUCAI1994
     * Date: 5/22/2017
     * Time: 10:47 AM
     */
    require_once '../model/DetailOrder_model.php';
    require_once '../model/orders_model.php';
    $method = isset($_GET['m']) ? $_GET['m'] : 'index';
    switch ($method){
        case 'index':
            listAllDetailOrders();
            break;
        case 'delete':
            deleteDetailOrder();
            break;
        case 'export':
            exportOrder();
            break;
        default:
            listAllDetailOrders();
            break;
    }

    function listAllDetailOrders()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $keyword = isset($_GET['keyword'])? $_GET['keyword'] : "";
        $dataOrd = getAllDataDetailOrder($keyword);
        $link = createLink(BASE_URL, array("sk"=>"detail_order", "m"=>"index", "page"=>'{page}', "keyword"=>$keyword));
        $dataPaging = paging($link, count($dataOrd), $page, ROW_LIMIT, $keyword);
        $dataOrder = getDataDetailOrderByPage($dataPaging['start'], $dataPaging['limit'], $dataPaging['keyword']);
        require_once '../view/detailorder/index_view.php';
    }

    // function show value
    function test($data = array())
    {
        echo "<pre/>";
        print_r($data);
        die();
    }


    // xuat hoa don
    function exportOrder()
    {
//        echo "<a href='../libs/PHPExcel/Classes/PHPExcel.php'>click</a>"; die();
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $id = is_numeric($id) ? $id : "";
        $OrderInfo = getDataInfoDetailOrder($id);
        require_once '../view/detailorder/exportOrder_view.php';


//        require_once '../libs/PHPExcel/Classes/PHPExcel.php';
//        $excel = new PHPExcel();
//        $excel->setActiveSheetIndex(0);
//        //Tạo tiêu đề cho trang. (có thể không cần)
//        $excel->getActiveSheet()->setTitle('demo ghi dữ liệu');
//
//        //Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
//        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
//        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
//        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
//        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
//        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
//
//        //Xét in đậm cho khoảng cột
//        $excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true)->setSize(24);
//        $excel->getActiveSheet()->getStyle('C6')->getFont()->setBold(true)->setSize(28);
//        $excel->getActiveSheet()->getStyle('C1:C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $excel->getActiveSheet()->setCellValue('C1', 'NHÀ SÁCH NGUYỄN VĂN CỪ');
//        $excel->getActiveSheet()->setCellValue('C2', 'Địa chỉ: Cầu Giấy - Hà Nội');
//        $excel->getActiveSheet()->setCellValue('C3', 'Điện thoại: 0966 432 963');
//        $excel->getActiveSheet()->setCellValue('C4', 'Website:bookstore.com.vn');
//        $excel->getActiveSheet()->setCellValue('C6', 'HÓA ĐƠN MUA HÀNG');
//
//        $excel->getActiveSheet()->getStyle('A7:E7')->getFont()->setBold(true);
//        $excel->getActiveSheet()->setCellValue('A7', 'STT');
//        $excel->getActiveSheet()->setCellValue('B7', 'Tên KH');
//        $excel->getActiveSheet()->setCellValue('C7', 'SĐT');
//        $excel->getActiveSheet()->setCellValue('D7', 'Email');
//        $excel->getActiveSheet()->setCellValue('E7', 'Địa chỉ');
//
////        $excel->getActiveSheet()->setCellValue('A8', '1');
////        $excel->getActiveSheet()->setCellValue('B8', $OrderInfo['TenKH']);
////        $excel->getActiveSheet()->setCellValue('C8', $OrderInfo['SDT']);
////        $excel->getActiveSheet()->setCellValue('D8', $OrderInfo['Email']);
////        $excel->getActiveSheet()->setCellValue('E8', $OrderInfo['DiaChi']);
//
//        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
//
//// Bước 9: Trả file về cho client download
//        header('Content-Type: application/vnd.ms-excel');
//        header('Content-Disposition: attachment;filename="bai-01-demo-excel-freetuts.net.xls"');
//        header('Cache-Control: max-age=0');
//        if (isset($objWriter)) {
//            $objWriter->save('php://output');
//        }
    }

    function deleteDetailOrder()
    {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $id = is_numeric($id) ? $id : 0;
        $dataInfo = getDataInfoDetailOrder($id);
       // var_dump($dataInfo); die();
        if (empty($dataInfo)) {
            require_once '../view/notfound_view.php';
        } else {
            // xoa hoa don trc
            $deleteDH = delete_orders_model($dataInfo['id_dh']);
            if ($deleteDH)
            {
                // xoa ctdh
                $delete = deleteDataDetailOrder($id);
//            var_dump($delete); die();
                if ($delete) {
                    $msg->success("Xoa thanh cong");
                    header("Location: ?sk=detail_order");
                } else {
                    $msg->error("Xoa that bai");
                    header("Location: ?sk=detail_order");
                }
            }else{
                $msg->error("Xoa that bai");
                header("Location: ?sk=detail_order");
            }

        }
    }