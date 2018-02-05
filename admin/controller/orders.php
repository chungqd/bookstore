<?php
require_once '../model/orders_model.php';
require_once '../model/books_model.php';
$method = isset($_GET['m']) ? $_GET['m'] : 'index';

switch ($method) {
    case 'index':
        listOrders();
    break;
    case 'update' :
        updateOrders();
    break;
}

function listOrders(){
    $dataOrders = get_all_orders_model();
    require_once '../view/orders/index_view.php';
}

function updateOrders(){
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $id = is_numeric($id) ? $id : 0;
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $type = (is_numeric($type) && in_array($type,array('1','2'))) ? $type : 0;


    if($id !=0 && $type !=0){
        // xu ly update
        if($type == 1){

        	$dataInfo = getDataOrderById($id);
   			$dataBook = get_info_data_book_model($dataInfo['id_sach']);
    		$qty = $dataBook['SoLuong'] - $dataInfo['SoLuong'];
    		if ($qty < 0) {
    			echo 'errqty';
    		}else{
	            $update = update_orders_model($id,$type);
	    		$updateQty = updateQtyBook_model($dataInfo['id_sach'], $qty);
	            if($update && $updateQty){

	                $detailOrders = save_detail_orders($id);
	                if($detailOrders){
	                    echo "ok";
	                }else{
	                    echo "err";
	                }

	            }else{
	                echo "errup";
	            }
       		}

        }elseif($type == 2){ // xu ly delete

            $delete = delete_orders_model($id);
            if($delete){
                echo "ok";
            }else{
                echo "errde";
            }
        }

    }else{
        echo "err";
    }

}

 ?>