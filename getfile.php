<?php

$url = $_GET['url'];
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