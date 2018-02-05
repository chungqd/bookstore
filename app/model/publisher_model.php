<?php  
require_once 'app/config/database.php';

	function get_list_book_by_publisher($idPublisherBook)
	{
		$data = array();
		$conn = connection();
		$sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE b.id_nxb = :id ORDER BY a.create_time DESC;";
		$stmt = $conn->prepare($sql);
		if($stmt){
		    $stmt->bindParam(':id',$idPublisherBook,PDO::PARAM_STR);
		    if($stmt->execute()){
		      if($stmt->rowCount() > 0){
		        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		      }
		    }
		    $stmt->closeCursor();
		}
		disconnection($conn);
		return $data;
	}
?>