<?php 
require_once 'config/database.php';

	function checkLogin_model($username, $password){
		$data = array();
		$conn = connection();
		$sql = "SELECT * FROM admin AS a WHERE a.username= :username AND a.password = :password LIMIT 1";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':username',$username,PDO::PARAM_STR);
			$stmt->bindPARAM(':password',$password,PDO::PARAM_STR);
			if ($stmt->execute()) 
			{
				if ($stmt->rowCount()>0) 
				{
					$data = $stmt->fetch(PDO::FETCH_ASSOC);				
				}
				
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $data;
	}

?>