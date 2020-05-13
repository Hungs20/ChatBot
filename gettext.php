<?php
$id = $_POST['id'];
$text = $_POST['text'];

echo ' {
	"messages": [
    {
      "text": "'.$text.'"
    }
  ]
}';
?>