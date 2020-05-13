
<?php
require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$id = $_POST['id'];
$noidung = $_POST['noidung'];

//$noidung = substr($noidung,1,strlen($noidung) - 1);
$errorChat = '{
     "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Lỗi !!!",
              "subtitle":"Đã xảy ra lỗi gửi tin. Bạn gửi lại thử nhé."
            }
          ]
        }
      }
    }
  ]
} ';
//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT ketnoi from users WHERE ID = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['ketnoi'];
  return $relationship;
}
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
///// Hàm gửi tin nhắn //////////
function isImage($url){
	$o = parse_url($url);
	if($o["scheme"] != 'https') return false;
	if((strpos($o["host"], 'fbcdn.net') !== false || strpos($o["host"], 'cdn.fbsbx.com') !== false)  && (endsWith($o["path"], '.png') || endsWith($o["path"], '.jpg') || endsWith($o["path"], '.jpeg') || endsWith($o["path"], '.gif')))
			return explode(" ", $url);
	return false;
}
function isVoid($url){
	$o = parse_url($url);
	if($o["scheme"] != 'https') return false;
	if(strpos($o["host"], 'cdn.fbsbx.com') !== false && (endsWith($o["path"], '.mp4') || endsWith($o["path"], '.acc') || endsWith($o["path"], '.mp3') ))
			return explode(" ", $url);
	return false;
}
function isVideo($url){
	$o = parse_url($url);
	if($o["scheme"] != 'https') return false;
	if(strpos($o["host"], 'video.xx.fbcdn.net') !== false && (endsWith($o["path"], '.mp4')  ))
			return explode(" ", $url);
	return false;	
}
function isFile($url){
	$o = parse_url($url);
	if($o["scheme"] != 'https') return false;
	if(strpos($o["host"], 'cdn.fbsbx.com') !== false && (endsWith($o["path"], '.pdf') || endsWith($o["path"], '.txt') || endsWith($o["path"], '.pptx') || endsWith($o["path"], '.xlxs') || endsWith($o["path"], '.docx') || endsWith($o["path"], '.zip') || endsWith($o["path"], '.rar') ))
			return explode(" ", $url);
	return false;
}
function sendchat($userid,$noidung){
global $JSON;
$payload = '{"'.$JSON.'":'.json_encode($noidung).'}';
if(isImage($noidung)) requestImage($userid, $payload);
else if(isVoid($noidung)) requestVoid($userid, $payload);
else if(isVideo($noidung)) requestVideo($userid, $payload);
else if(isFile($noidung)) requestFile($userid, $payload);
else requestText($userid,$payload);    
}

function requestText($userid,$jsondata) { // hàm gửi chát :)))
  global $TOKEN;
  global $BOT_ID;
  global $BLOCK_NAME;
  $url = "https://api.chatfuel.com/bots/$BOT_ID/users/$userid/send?chatfuel_token=$TOKEN&chatfuel_block_name=$BLOCK_NAME";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsondata));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);

	if (curl_errno($ch)) {
		echo errorChat;
	} else {
		$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($resultStatus == 200) {
			// send ok
		} else {
			echo errorChat;
		}
	}
	curl_close($ch);

}
function requestImage($userid,$jsondata) { // hàm gửi chát :)))
  global $TOKEN;
  global $BOT_ID;
  global $BLOCK_IMAGE;
  $url = "https://api.chatfuel.com/bots/$BOT_ID/users/$userid/send?chatfuel_token=$TOKEN&chatfuel_block_name=$BLOCK_IMAGE";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
  	if (curl_errno($ch)) {
		echo errorChat;
	} else {
		$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($resultStatus == 200) {
			// send ok
		} else {
			echo errorChat;
		}
	}
	curl_close($ch);
}
function requestVoid($userid,$jsondata) { // hàm gửi chát :)))
  global $TOKEN;
  global $BOT_ID;
  global $BLOCK_VOID;
  $url = "https://api.chatfuel.com/bots/$BOT_ID/users/$userid/send?chatfuel_token=$TOKEN&chatfuel_block_name=$BLOCK_VOID";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
  	if (curl_errno($ch)) {
		echo errorChat;
	} else {
		$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($resultStatus == 200) {
			// send ok
		} else {
			echo errorChat;
		}
	}
	curl_close($ch);
}
function requestVideo($userid,$jsondata) { // hàm gửi chát :)))
  global $TOKEN;
  global $BOT_ID;
  global $BLOCK_VIDEO;
  $url = "https://api.chatfuel.com/bots/$BOT_ID/users/$userid/send?chatfuel_token=$TOKEN&chatfuel_block_name=$BLOCK_VIDEO";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
  	if (curl_errno($ch)) {
		echo errorChat;
	} else {
		$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($resultStatus == 200) {
			// send ok
		} else {
			echo errorChat;
		}
	}
	curl_close($ch);
}
function requestFile($userid,$jsondata) { // hàm gửi chát :)))
  global $TOKEN;
  global $BOT_ID;
  global $BLOCK_FILE;
  $url = "https://api.chatfuel.com/bots/$BOT_ID/users/$userid/send?chatfuel_token=$TOKEN&chatfuel_block_name=$BLOCK_FILE";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
  	if (curl_errno($ch)) {
		echo errorChat;
	} else {
		$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($resultStatus == 200) {
			// send ok
		} else {
			echo errorChat;
		}
	}
	curl_close($ch);
}
$partner = getRelationship($id);

if($partner){
sendchat($partner,$noidung);
}else{
echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Đang thả câu...",
              "subtitle":"Chưa có cá nào dính thính đâu. Hãy chờ tiếp bạn nhé!"
            }
          ]
        }
      }
    }
  ]
}';
}

?>