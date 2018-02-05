<?php
require_once 'app/config/database.php';
// ham cap nhat so luot xem
function update_viewer_model($id,$view){
  $view = ($view > 0) ? ($view+=1) : 1;
  $flag = FALSE;
  $conn = connection();
  $sql = "UPDATE sach AS a SET a.SoLuotXem = :view WHERE a.id = :id";
  $stmt = $conn->prepare($sql);
  if ($stmt) {
    $stmt->bindPARAM(':view', $view, PDO::PARAM_INT);
    $stmt->bindPARAM(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $flag = TRUE;
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $flag;
}

// them hoa don
function insert_order_customer_model($idBook, $fullname, $phone, $email, $address, $note, $qty,$money){
  $flag = FALSE;
  $conn = connection();
  $create_time = date('Y-m-d H:i:s');
  $update_time = '';
  $status = 0;
  $sql = "INSERT INTO donhang(id_sach, TenKH, SDT, Email, DiaChi, GhiChu, SoLuong, ThanhTien, TrangThai, create_time, update_time) VALUES(:id_sach, :TenKH, :SDT, :Email, :DiaChi, :GhiChu, :SoLuong, :ThanhTien, :TrangThai, :create_time, :update_time)";
  $stmt = $conn->prepare($sql);
  if ($stmt) {
    $stmt->bindPARAM(':id_sach', $idBook, PDO::PARAM_INT);
    $stmt->bindPARAM(':TenKH', $fullname, PDO::PARAM_STR);
    $stmt->bindPARAM(':SDT', $phone, PDO::PARAM_STR);
    $stmt->bindPARAM(':Email', $email, PDO::PARAM_STR);
    $stmt->bindPARAM(':DiaChi', $address, PDO::PARAM_STR);
    $stmt->bindPARAM(':GhiChu', $note, PDO::PARAM_STR);
    $stmt->bindPARAM(':SoLuong', $qty, PDO::PARAM_INT);
    $stmt->bindPARAM(':ThanhTien', $money, PDO::PARAM_STR);
    $stmt->bindPARAM(':TrangThai', $status, PDO::PARAM_INT);
    $stmt->bindPARAM(':create_time', $create_time, PDO::PARAM_STR);
    $stmt->bindPARAM(':update_time', $create_time, PDO::PARAM_STR);
    if ($stmt->execute()) {
      $flag = TRUE;
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $flag;
}

function get_list_all_book_model(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai ORDER BY a.create_time DESC;";
  $stmt = $conn->prepare($sql);
  if($stmt){
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

function getDataBookByPage($start,$limit,$keyword=""){
    $conn = connection();
    $data = array();
    $key = "%".$keyword."%";
    $sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE a.TenSach LIKE :key OR b.TenNXB LIKE :key OR c.TenTG LIKE :key OR d.TenLoai LIKE :key LIMIT :start, :limmit";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
      $stmt->bindPARAM(':start',$start,PDO::PARAM_INT);
      $stmt->bindPARAM(':limmit',$limit,PDO::PARAM_INT);
      $stmt->bindPARAM(':key',$key,PDO::PARAM_STR);
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

  function get_info_data_book_byId($id){
  $data = array();
  $conn = connection();
  $sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE a.id = :id LIMIT 1";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindPARAM(":id",$id,PDO::PARAM_INT);
    if($stmt->execute()){
      if($stmt->rowCount() > 0){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    }
    $stmt->closeCursor();
  }
  disconnection($conn);
  return $data;
  }

  function get_typebook($id,$idb){
   $data = array();
  $conn = connection();
  $sql  = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai,d.TenLoai FROM sach AS a INNER JOIN  nhaxuatban AS b ON a.id_nxb = b.id_nxb INNER JOIN tacgia AS c ON a.id_tg = c.id_tg INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE a.id_loai = :id AND a.id <> :idb  LIMIT 0,10";
  $stmt = $conn->prepare($sql);
  if($stmt){
    $stmt->bindPARAM(":id",$id,PDO::PARAM_INT);
    $stmt->bindPARAM(":idb",$idb,PDO::PARAM_INT);
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