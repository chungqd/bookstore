<?php
/**
    * Created by PhpStorm.
    * User: CUCAI1994
    * Date: 5/20/2017
    * Time: 11:27 PM
    */
    require_once '../config/database.php';

    function getAllDataMember($keyword = "")
    {
        $data = array();
        $conn = connection();
        $key = "%".$keyword."%";
        $sql = "SELECT * FROM taikhoan WHERE TenDangNhap LIKE :keyword OR TenHienThi LIKE :keyword OR SDT LIKE :keyword OR Email LIKE :keyword";
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
        disconection($conn);
        return $data;
    }

    function getDataMemberByPage($start, $limit, $keyword = "")
    {
        $data = array();
        $conn = connection();
        $key = "%".$keyword."%";
        $sql = "SELECT * FROM taikhoan AS tk WHERE tk.TenDangNhap LIKE :keyword OR tk.TenHienThi LIKE :keyword OR tk.SDT LIKE :keyword OR tk.Email LIKE :keyword ORDER BY tk.create_time DESC LIMIT :start, :limmit";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":keyword",$key, PDO::PARAM_STR);
            $stmt->bindParam(":start", $start, PDO::PARAM_INT);
            $stmt->bindParam(":limmit", $limit, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }
        disconection($conn);
        return $data;
    }

    function getDataInfoMember($id)
    {
        $data = array();
        $conn = connection();
        $sql = "SELECT * FROM taikhoan WHERE id_tk = :id_tk";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":id_tk", $id, PDO::PARAM_INT);
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

    function deleteDataMember($id)
    {
        $flag = false;
        $conn = connection();
        $sql = "DELETE FROM taikhoan WHERE id_tk = :id_tk";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":id_tk", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $flag = true;
            }
            $stmt->closeCursor();
        }
        disconection($conn);
        return $flag;
    }

//    function getStatusMember()
//    {
//        $data = array();
//        $conn = connection();
//        $sql = "SELECT tk.Trang_thai FROM taikhoan AS tk";
//        $stmt = $conn->prepare($sql);
//        if ($stmt) {
//            if ($stmt->execute()) {
//                if ($stmt->rowCount() > 0) {
//                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
//                }
//            }
//            $stmt->closeCursor();
//        }
//        disconection($conn);
//        return $data;
//    }
        function getInfoDataMember_model($id)
        {
            $data = array();
            $conn = connection();
            $sql = "SELECT * FROM taikhoan WHERE id_tk = :id_tk";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bindParam(":id_tk", $id, PDO::PARAM_INT);
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

        function updateInfoData_model($status, $id)
        {
            $flag = false;
            $conn = connection();
            $sql = "UPDATE taikhoan SET Trang_thai = :Trang_thai WHERE id_tk = :id_tk";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bindParam(":Trang_thai",$status, PDO::PARAM_INT);
                $stmt->bindParam(":id_tk",$id, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $flag = true;
                }
                $stmt->closeCursor();
            }
            disconection($conn);
            return $flag;
        }

