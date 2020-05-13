<?php
require_once 'config.php'; //lấy thông tin từ config
function isNudeImage($url)
{
    $url = urlencode($url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.sightengine.com/1.0/check.json?models=nudity&api_user=$NUDE_API_USER&api_secret=$NUDE_API_SECRET&url=$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $res = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($res, true);
    if($result['status'] == 'success'){
       // echo 'Raw: '. $result['nudity']['raw'] . 'Safe: '. $result['nudity']['safe'] . 'Patial: '. $result['nudity']['partial'];
        if($result['nudity']['raw'] >= max($result['nudity']['safe'], $result['nudity']['partial'])) return 1;
        else if($result['nudity']['partial'] >= max($result['nudity']['raw'], $result['nudity']['safe'])) 
        {
            if($result['nudity']['partial_tag'] == 'bikini' || $result['nudity']['partial_tag'] == 'lingerie') return 1;
        }
    }
    return 0;
}

$id = $_POST['id'];
$url = $_POST['url'];
$isNude = isNudeImage($url);
if($isNude == 0)
{
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
}
else
{
    echo '{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "image_aspect_ratio": "square",
          "elements":[
            {
              "title":"Cảnh báo",
              "subtitle":"Cá đã gửi nội dung nhạy cảm",
              "buttons":[
                {
                  "type":"web_url",
                  "url":"'.$url.'",
                  "title":"Xem nội dung này"
                }
              ]
            }
          ]
        }
      }
    }
  ]
}';
}

?>