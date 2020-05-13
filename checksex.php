<?php
function isNudeImage($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.sightengine.com/1.0/check.json?models=nudity&api_user=545033772&api_secret=qnKfMmMX5qvgSHq9oRdR&url=$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $res = curl_exec($ch);
    printf($res);
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
function isNude($urlImg)
{
   $ch = curl_init("https://api.deepai.org/api/nsfw-detector");
    $param = array('image' => $urlImg);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = array();
$headers[] = 'api-key:2800c887-35b8-44eb-9eff-079bb405d430';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, count($param));
curl_setopt($ch, CURLOPT_POSTFIELDS, $param); 
$result = curl_exec($ch);
curl_close($ch);
$res = json_decode($result, true);
if($res['output']['nsfw_score'] > 0.5) return 1;
else return 0;
//printf($result);
}
function isNude2($urlImg)
{
   $ch = curl_init("https://api.uploadfilter.io/v1/nudity");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$headers = array('apikey:c1b26790-7491-11ea-9a6f-8ba0d6c2447f', 'url:'.$urlImg);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
curl_close($ch);
$res = json_decode($result, true);
if($res['result']['classification_code'] > 0) return 1;
else return 0;
}
echo isNude2($_GET['url']);
//echo isNude($_GET['url']);
//echo isNudeImage($_GET['url']);
?>