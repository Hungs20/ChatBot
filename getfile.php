<?php
require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$id = $_POST['id'];
$url = $_POST['url'];
$sql = "INSERT INTO `data` (`userID`, `text`, `type`) VALUES ('$id', '$url', 'file')";
$info = mysqli_query($conn,$sql );
mysqli_close($conn);
echo ' {
	"messages": [
    {
      "attachment": {
        "type": "file",
        "payload": {
          "url": "'.$url.'"
        }
      }
    }
  ]
}';
?>