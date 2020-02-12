<?php

$url = $_GET['url'];
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