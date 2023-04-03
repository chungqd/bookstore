<?php
function connection(){
  try{
    $dbh = new PDO('mysql:host=mysql;dbname=bookhost;charset=utf8','root', 'secret');
    // $dbh = new PDO('mysql:host=mysql.hostinger.vn;dbname=u361173269_book;charset=utf8', 'u361173269_admin', '12345678');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
