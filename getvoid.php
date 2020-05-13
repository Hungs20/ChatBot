<?php
require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$id = $_POST['id'];
$url = $_POST['url'];
$sql = "INSERT INTO `data` (`userID`, `text`, `type`) VALUES ('$id', '$url', 'audio')";
$info = mysqli_query($conn,$sql );
mysqli_close($conn);
echo ' {
  "messages": [
    {
      "attachment": {
        "type": "audio",
        "payload": {
          "url": "'.$url.'"
        }
      }
    }
  ]
}';
?>