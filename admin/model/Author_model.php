<?php  
    require_once '../config/database.php';

    function getAllDataAuthor($keyword="")
    {
        $data = array();
        $conn = connection();
        $key = "%".$keyword."%";
        $sql = "SELECT * FROM tacgia AS tg WHERE tg.TenTG LIKE :keyword OR tg.SDTTG LIKE :keyword OR tg.DiaChiTG LIKE :keyword";
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

    function getDataAuthorByPage($start, $limit, $keyword = '')
    {
        $data = array();
        $conn = connection();
        $key = "%".$keyword."%";
        $sql = "SELECT * FROM tacgia AS tg WHERE tg.TenTG LIKE :keyword OR tg.SDTTG LIKE :keyword OR tg.DiaChiTG LIKE :keyword ORDER BY tg.create_time DESC LIMIT :start, :limmit";
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
        disconection($conn);
        return $data;
    }

    // kiem tra id co trong db ko
    function getDataInfoAuthor($id)
    {
        $data = array();
        $conn = connection();
        $sql = "SELECT * FROM tacgia WHERE id_tg = :id_tg";
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

    // ham xoa tac gia
    function deleteDataAuthor($id)
    {
        $flag = false;
        $conn = connection();
        $sql = "DELETE FROM tacgia WHERE id_tg = :id_tg";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":id_tg", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $flag = true;
            }
            $stmt->closeCursor();
        }
        disconection($conn);
        return $flag;
    }

    function checkExistNameAuthor($name)
     {
         $flag = true;
         $conn = connection();
         $sql = "SELECT * FROM tacgia WHERE TenTG = :TenTG";
         $stmt = $conn->prepare($sql);
         if ($stmt)
         {
             $stmt->bindParam(":TenTG", $name, PDO::PARAM_STR);
             if ($stmt->execute())
             {
                 if ($stmt->rowCount()>0)
                 {
                     $flag = false;
                 }
             }
             $stmt->closeCursor();
         }
         disconection($conn);
         return $flag;
     }

     function addInfoAuthor_model($name, $phone, $address,$img)
     {
         $flag = false;
         $conn = connection();
         $create_time = date("Y-m-d H:i:s");
         $update_time = "";
         $sql = "INSERT INTO tacgia(TenTG, SDTTG, DiaChiTG, img_path, create_time, update_time) VALUES(:TenTG, :SDTTG, :DiaChiTG, :img_path, :create_time, :update_time)";
         $stmt = $conn->prepare($sql);
         if ($stmt)
         {
             $stmt->bindParam(":TenTG", $name, PDO::PARAM_STR);
             $stmt->bindParam(":SDTTG", $phone, PDO::PARAM_STR);
             $stmt->bindParam(":DiaChiTG", $address, PDO::PARAM_STR);
             $stmt->bindParam(":img_path",$img, PDO::PARAM_STR);
             $stmt->bindParam(":create_time", $create_time, PDO::PARAM_STR);
             $stmt->bindParam("update_time", $update_time, PDO::PARAM_STR);
             if ($stmt->execute())
             {
                 $flag = true;
             }
             $stmt->closeCursor();
         }
         disconection($conn);
         return $flag;
     }

     // ham sua tac gia
    function updateDataAuthor_model($name, $phone, $address, $imgAu, $id)
    {
        $flag = false;
        $conn = connection();
        $update_time = date("Y-m-d H:i:s");
        $sql = "UPDATE tacgia AS tg SET tg.TenTG = :TenTG, tg.SDTTG = :SDTTG, tg.DiaChiTG = :DiaChiTG, tg.img_path = :img_path, tg.update_time = :update_time WHERE tg.id_tg = :id_tg";
        $stmt = $conn->prepare($sql);
        if ($stmt)
        {
            $stmt->bindParam(":TenTG", $name, PDO::PARAM_STR);
            $stmt->bindParam(":SDTTG", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":DiaChiTG", $address, PDO::PARAM_STR);
            $stmt->bindParam(":img_path", $imgAu, PDO::PARAM_STR);
            $stmt->bindParam(":update_time", $update_time, PDO::PARAM_STR);
            $stmt->bindParam(":id_tg", $id, PDO::PARAM_INT);
            if ($stmt->execute())
            {
                $flag = true;
            }
            $stmt->closeCursor();
        }
        disconection($conn);
        return $flag;

    }
?>