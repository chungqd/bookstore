<?php
function connection(){
  try{
    $dbh = new PDO('mysql:host=localhost;dbname=bookhost;charset=utf8','root', '');
    // $dbh = new PDO('mysql:host=mysql.hostinger.vn;dbname=u361173269_book;charset=utf8', 'u361173269_admin', '12345678');
    return $dbh;

  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}

function disconnection($conn)
{
  $conn = null;
}

 ?>
