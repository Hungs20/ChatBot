<?php
$id = $_POST['id'];
$url = $_POST['url'];
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