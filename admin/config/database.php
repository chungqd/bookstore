<?php
function connection(){
  try{
    // $dbh = new PDO('mysql:host=localhost;dbname=bookhost;charset=utf8','root', '');
    $dbh = new PDO('mysql:host=mysql;dbname=bookhost;charset=utf8','root', 'secret');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // show error when dev
    return $dbh;

  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
// disconection()
function disconection($conn)
{
  $conn = null;
}

 ?>
