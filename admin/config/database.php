<?php
function connection(){
  try{
    $dbh = new PDO('mysql:host=localhost;dbname=bookhost;charset=utf8','root', '');
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
