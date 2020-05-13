<?php
	require_once 'config.php'; //lấy thông tin từ config
	$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
	$id = $_POST['id'];
	$result = mysqli_query($conn, "SELECT * from `users` WHERE `ID` = $id");
	$row = mysqli_fetch_assoc($result);
	$gt = ($row['gioitinh'] == '1') ? 'Nam' : 'Nữ';
	$tt = 'Chưa kết nối';
	$quick_title = 'Thả câu';
	$quick_block = 'thamgia';
	$quick_title2 = 'Hướng dẫn';
	$quick_block2 = 'huongdan';
	if($row['trangthai'] == '1') {
		$tt = 'Đã kết nối với ID '. $row['ketnoi'] ;
		$quick_title = 'End chat';
		$quick_block = 'xacnhan';
		$quick_title2 = 'Block';
		$quick_block2 = 'xacnhanblock';
	}
	if($row['hangcho'] == '1') {
		$tt = 'Đang tìm kiếm';
		$quick_title = 'Dừng tìm kiếm';
		$quick_block = 'thoat';
	}
	echo '{
 "messages": [
	{"text": "ID: '.$id.'"},
	{"text": "Giới tính: '.$gt.'"},
	{"text": "Trạng thái: '.$tt.'",
	"quick_replies": [
        {
          "title":"'.$quick_title.'",
          "block_names": ["'.$quick_block.'", "'.$quick_block2.'"]
        }
      ]
	}
 ]
}';
	mysqli_close($conn);
?>