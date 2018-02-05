<?php  
require_once 'app/config/database.php';
  function get_list_book_by_price($idPriceBook)
  {
    $data = array();
    $conn = connection();
    if ($idPriceBook == 1) {
      $sql = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE (a.GiaCu BETWEEN 0 AND 490000) AND (a.GiaMoi BETWEEN 0 AND 490000)";
    }elseif ($idPriceBook == 2) {
      $sql = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE (a.GiaCu BETWEEN 50000 AND 99000)";
    }elseif ($idPriceBook == 3) {
      $sql = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE a.GiaCu >= 100000";
    }
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
      if ($stmt->execute()) {
        if ($stmt->rowCount()>0) {
          $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
      }
      $stmt->closeCursor();
    }
    disconnection($conn);
    return $data;
  }
?>