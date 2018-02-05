<?php 
	require_once '../config/database.php';
	function add_info_publisher_model($name, $phone, $address, $logo)
	{
		$checkFlag = FALSE;
		$conn = connection();
		$create_time = date("Y-m-d H:i:s");
		$update_time = '';
		$sql = "INSERT INTO nhaxuatban(TenNXB, SDTNXB, DiaChiNXB, logo_NXB, create_time, update_time) VALUES(:TenNXB, :SDTNXB, :DiaChiNXB, :logo_NXB, :create_time, :update_time)";
		$stmt=$conn->prepare($sql);
		if ($stmt) 
		{
			$stmt->bindPARAM(':TenNXB',$name,PDO::PARAM_STR);
			$stmt->bindPARAM(':SDTNXB',$phone,PDO::PARAM_STR);
			$stmt->bindPARAM(':DiaChiNXB',$address,PDO::PARAM_STR);
			$stmt->bindPARAM(':logo_NXB',$logo,PDO::PARAM_STR);
			$stmt->bindPARAM(':create_time',$create_time,PDO::PARAM_STR);
			$stmt->bindPARAM(':update_time',$update_time,PDO::PARAM_STR);
			if ($stmt->execute()) 
			{
				$checkFlag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $checkFlag;
	}

	function checkPublisher($tennxb){ // check xem nxb nhập vào có trùng với csdl ko
		$conn = connection();
		$checkFlag = TRUE;
		$sql = "SELECT * FROM nhaxuatban AS nxb WHERE nxb.TenNXB = :tennxb";
		$stmt = $conn->prepare($sql);
		if ($stmt) 
		{
			$stmt->bindPARAM(':tennxb',$tennxb,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$checkFlag = FALSE;
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $checkFlag;
	}

	function getAllDataPublisher($keyword=""){
		$conn = connection();
		$data = array();
		$key = "%".$keyword."%";
		$sql = "SELECT * FROM nhaxuatban AS a WHERE a.TenNXB LIKE :keyword OR a.SDTNXB LIKE :keyword OR a.DiaChiNXB LIKE :keyword";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":keyword",$key,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $data;
	}

	function getDataInfoPublisher($idPb){
		$conn = connection();
		$data = array();
		$sql = "SELECT * FROM nhaxuatban AS nxb WHERE nxb.id_nxb= :id_nxb";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':id_nxb',$idPb,PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $data;
	}

	function editDataInfoPublisher($id,$name, $phone, $address, $logo){
		$checkFlag = FALSE;
		$conn = connection();
		$update_time = date("Y-m-d H:i:s");
		$sql = "UPDATE nhaxuatban SET TenNXB = :tennxb, SDTNXB = :sdtnxb, DiaChiNXB = :diachinxb, logo_NXB =:logonxb, update_time =:update_time WHERE id_nxb = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":id",$id,PDO::PARAM_INT);
			$stmt->bindPARAM(":tennxb",$name,PDO::PARAM_STR);
			$stmt->bindPARAM(":sdtnxb",$phone,PDO::PARAM_STR);
			$stmt->bindPARAM(':diachinxb',$address,PDO::PARAM_STR);
			$stmt->bindPARAM(':logonxb',$logo, PDO::PARAM_STR);
			$stmt->bindPARAM(':update_time',$update_time, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$checkFlag  = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $checkFlag;
	}

	// Ham Xoa Publisher
	function deletePublisher_model($id){
		$conn = connection();
		$checkFlag = FALSE;
		$sql = "DELETE FROM nhaxuatban WHERE id_nxb = :id_nxb";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':id_nxb',$id,PDO::PARAM_INT);
			if ($stmt->execute()) {
				$checkFlag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $checkFlag;
	}

	function getDataPublisherByPage($start,$limit,$keyword=""){
		$conn = connection();
		$data = array();
		$key = "%".$keyword."%";
		$sql = "SELECT * FROM nhaxuatban AS a  WHERE a.TenNXB LIKE :keyword OR a.SDTNXB LIKE :keyword OR a.DiaChiNXB LIKE :keyword ORDER BY a.create_time DESC  LIMIT :start, :limmit";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':start',$start,PDO::PARAM_INT);
			$stmt->bindPARAM(':limmit',$limit,PDO::PARAM_INT);
			$stmt->bindPARAM(':keyword',$key,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $data;
	}
?>