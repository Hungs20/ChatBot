<?php
require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$id = $_POST['id'];
$url = $_POST['url'];
$sql = "INSERT INTO `data` (`userID`, `text`, `type`) VALUES ('$id', '$url', 'video')";
$info = mysqli_query($conn,$sql );
mysqli_close($conn);
echo ' {
	"messages": [
    {
      "attachment": {
        "type": "video",
        "payload": {
          "url": "'.$url.'"
        }
      }
    }
  ]
}';
?>