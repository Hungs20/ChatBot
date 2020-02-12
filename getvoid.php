<?php
$url = $_GET['url'];
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