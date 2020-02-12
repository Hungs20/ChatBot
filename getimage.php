<?php

$url = $_GET['url'];
echo ' {
  "messages": [
    {
      "attachment": {
        "type": "image",
        "payload": {
          "url": "'.$url.'"
        }
      }
    }
  ]
}';
?>