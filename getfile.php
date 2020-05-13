<?php

$id = $_POST['id'];
$url = $_POST['url'];
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