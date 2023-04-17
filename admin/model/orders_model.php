<?php  
	require_once "../config/database.php";
	// ham cap nhap lai trang thai cua don hang
	function update_orders_model($id, $type){
		$flag = FALSE;
		$conn = connection();
		$sql = "UPDATE donhang AS a SET a.TrangThai = :TrangThai WHERE a.id_hd = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":TrangThai", $type, PDO::PARAM_INT);
			$stmt->bindPARAM(":id", $id, PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $flag;
	}

	// luu vao cho tiet hoa don
	function save_detail_orders($id){
		$flag = FALSE;
		$conn = connection();
		$create_time = date("Y-m-d H:i:s");
		$update_time = NULL;
		$sql = "INSERT INTO chitiethoadon(id_dh,create_time,update_time) VALUES(:id_dh,:create_time,:update_time)";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':id_dh', $id, PDO::PARAM_INT);
			$stmt->bindPARAM(':create_time', $create_time, PDO::PARAM_STR);
			$stmt->bindPARAM(':update_time', $update_time, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $flag;
	}

	// hàm xóa đơn hàng
	function delete_orders_model($id){
		$flag = FALSE;
		$conn = connection();
		$sql = "DELETE FROM donhang WHERE id_hd = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':id',$id,PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $flag;
	}

	function get_all_orders_model(){
		$data = array();
		$status = 0;
		$conn = connection();
		$sql = "SELECT a.id_sach, a.TenKH, a.SDT, a.Email, a.DiaChi, a.GhiChu, a.SoLuong, a.ThanhTien, a.TrangThai, a.create_time, a.update_time,a.id_hd, b.TenSach, b.HinhAnh FROM donhang AS a INNER JOIN sach AS b ON a.id_sach = b.id WHERE a.TrangThai = :TrangThai ORDER BY a.create_time DESC";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':TrangThai', $status, PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);

		// xu li data do ra view
		$orderBook = array();
		foreach ($data as $k => $val) {
			$orderBook[$val['id_sach']]['imgBook'] = $val['HinhAnh'];
			$orderBook[$val['id_sach']]['nameBook'] = $val['TenSach'];
			$orderBook[$val['id_sach']]['ltsOrder'][] = $val;
		}
		return $orderBook;
	}

	function getDataOrderById($id)
	{
		$data = array();
		$status = 0;
		$conn = connection();
		$sql = "SELECT * FROM donhang WHERE id_hd = :id_hd AND TrangThai = :TrangThai";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':id_hd', $id, PDO::PARAM_INT);
			$stmt->bindPARAM(':TrangThai', $status, PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $data;
	}

	// update qty book
	function updateQtyBook_model($id, $qty)
	{
		$flag = false;
		$conn = connection();
		$sql = "UPDATE sach SET SoLuong = :SoLuong WHERE id = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':id', $id, PDO::PARAM_INT);
			$stmt->bindPARAM(':SoLuong', $qty, PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flag = true;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $flag;
	}
?>