<?php
require_once 'app/config/database.php';

// get data author
function get_all_author_model(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM tacgia";
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

//get data type book
function get_all_typebook_model(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM loaisach";
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

//get data publisher
function get_all_publisher_model(){
  $data = array();
  $conn = connection();
  $sql  = "SELECT * FROM nhaxuatban";
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


?>