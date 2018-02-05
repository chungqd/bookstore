<?php 
	function get_username_admin(){
		$username = isset($_SESSION['username'])?$_SESSION['username']:"";
		return $username;
	}

	function get_email_admin(){
		$email = isset($_SESSION['email'])?$_SESSION['email']:"";
		return $email;
	}

	function checkLogin_admin(){
		$username = get_username_admin();
		$email = get_email_admin();
		$cookie = get_cookie_admin();
		if (empty($username) OR empty($email) OR empty($cookie)) {
			session_destroy();
			header("Location: ../index.php");
			die();
		}
	}

	function uploadFiles($file, $type){
		if ($file['txtFile']['error'] == 0) {
			$tmtPath = $file['txtFile']['tmp_name'];
			if (!empty($tmtPath)) {
				$path ="";
				switch ($type) {
					case "1":
						$path = "../../upload/logoPublisher/".$file['txtFile']['name'];
						break;
					case "2":
						$path = "../../upload/imgBook/".$file['txtFile']['name'];
						break;
					case "3":
						$path = "../../upload/imgAuthor/".$file['txtFile']['name'];
						break;
					
				}
				if (!empty($path)) {
					$up = move_uploaded_file($tmtPath,$path);
					if ($up) {
						return $file['txtFile']['name'];
					}
					return;
				}
			}
		}
	}


// lay cookie
	function get_cookie_admin(){
		$cookie = isset($_COOKIE['admin'])?$_COOKIE['admin']:"";
		return $cookie;
	}
// uri là base url đường dẫn cơ bản, filter là các tham số trên link của controller nào đó
	function createLink($uri, $filter = array()){
		$string = "";
		foreach ($filter as $k => $v) {
			$string.="&{$k}={$v}"; // nối chuỗi url  Vd: sk = pusblisher
		}
		return $uri .($string ? "?".ltrim($string,"&"):"");
	}

	function paging($link, $totalRecord, $currentPage, $limit, $keyword = ""){
		// tính tổng số trang
		$totalPage = ceil($totalRecord/$limit);
		// xu ly giới hạn cho currentPage
		if ($currentPage > $totalPage) {
			$currentPage = $totalPage;
		}
		elseif ($currentPage<1) {
			$currentPage = 1;
		}

		// tính start
		$start = ($currentPage-1)*$limit;

		// tạo template phân trang
		$html = "<div class='text-center'>";
		$html .= "<nav aria-label='Page navigation'>";
		$html .= "<ul class='pagination'>";
		// kiểm tra nút back
		if ($currentPage > 1 && $totalPage > 1) {
			//$html .= "<li><a href='".str_replace('{page}',$currentPage-1, $link)."' aria-label='Previous' ></a></li>";
			$html .= "<li><a href='".str_replace('{page}',$currentPage-1, $link)."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
		}
		// tính các trang ở giữa
		for($i = 1; $i<=$totalPage;$i++){
			// trường hợp currentpage bằng trang hiển thị
			if ($i == $currentPage) {
				$html .= " <li class='active'><a>".$i."<span class='sr-only'></span></a></li>";
			}
			else{
				$html .= "<li><a href='".str_replace('{page}',$i,$link)."'>".$i."<span class='sr-only'></span></a></li>";
			}
		}

		// xu ly nut next
		if ($currentPage<$totalPage && $totalPage > 1) {
			$html .= "<li><a href='".str_replace('{page}',$currentPage+1, $link)."' ><span aria-hidden='true'>&raquo;</span></a></li>";
		}

		$html .="</ul>";
		$html .="</nav>";
		$html .= "</div>";

		return array(
			"start" => $start,
			"html" =>$html,
			"keyword" =>$keyword,
			"limit" => $limit
			);
	}
?>