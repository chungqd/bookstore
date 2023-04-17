<?php
    /**
     * Created by PhpStorm.
     * User: CUCAI1994
     * Date: 5/22/2017
     * Time: 10:48 AM
     */
    require_once '../config/database.php';

    function getAllDataDetailOrder($keyword ="")
    {
        $data = array();
        $conn = connection();
        $key = "%".$keyword."%";
        $sql = "SELECT a.id_hoadon, b.TenKH, b.SDT, b.Email, b.DiaChi, b.SoLuong, b.ThanhTien, b.TrangThai, c.TenSach, c.HinhAnh FROM chitiethoadon AS a INNER JOIN donhang AS b ON a.id_dh = b.id_hd INNER JOIN sach AS c ON b.id_sach = c.id WHERE b.TenKH LIKE :keyword OR b.SDT LIKE :keyword OR b.Email = :keyword OR b.DiaChi LIKE :keyword OR c.TenSach LIKE :keyword";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":keyword", $key, PDO::PARAM_STR);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }
        disconection($sql);
        return $data;
    }

    function getDataDetailOrderByPage($start, $limit, $keyword = "")
    {
        $data = array();
        $conn = connection();
        $key = "%".$keyword."%";
        $sql = "SELECT a.id_hoadon, b.TenKH, b.SDT, b.Email, b.DiaChi, b.SoLuong, b.ThanhTien, b.TrangThai, c.TenSach, c.HinhAnh FROM chitiethoadon AS a INNER JOIN donhang AS b ON a.id_dh = b.id_hd INNER JOIN sach AS c ON b.id_sach = c.id WHERE b.TenKH LIKE :keyword OR b.SDT LIKE :keyword OR b.Email = :keyword OR b.DiaChi LIKE :keyword OR c.TenSach LIKE :keyword LIMIT :start, :limmit";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":keyword", $key, PDO::PARAM_STR);
            $stmt->bindParam(":start", $start, PDO::PARAM_INT);
            $stmt->bindParam(":limmit", $limit, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }
        disconection($sql);
        return $data;
    }

    function  getDataInfoDetailOrder($id)
    {
        $data = array();
        $conn = connection();
        $sql = "SELECT a.id_hoadon, a.id_dh, b.TenKH, b.SDT, b.Email, b.DiaChi, b.SoLuong, b.ThanhTien, b.TrangThai, b.create_time, c.TenSach, c.HinhAnh, c.GiaCu, c.GiaMoi FROM chitiethoadon AS a INNER JOIN donhang AS b ON a.id_dh = b.id_hd INNER JOIN sach AS c ON b.id_sach = c.id WHERE id_hoadon = :id_tg";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":id_tg", $id, PDO::PARAM_INT);
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

    function deleteDataDetailOrder($id)
    {
        $flag = false;
        $conn = connection();
        $sql = "DELETE FROM chitiethoadon WHERE id_hoadon = :id_hoadon";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":id_hoadon", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $flag = true;
            }
            $stmt->closeCursor();
        }
        disconection($conn);
        return $flag;
    }