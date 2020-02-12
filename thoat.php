<?php

$ID = $_GET['ID'];// lấy id từ chatfuel
require_once 'config.php'; //lấy thông tin từ config

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT ketnoi from users WHERE ID = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['ketnoi'];
  return $relationship;
}

////// Hàm Gửi JSON //////////
function request($userid,$jsondata) { 
  global $TOKEN;
  global $BOT_ID;
  global $BLOCK_NAME;
  $url = "https://api.chatfuel.com/bots/$BOT_ID/users/$userid/send?chatfuel_token=$TOKEN&chatfuel_block_name=$BLOCK_NAME";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
}
///// Hàm gửi tin nhắn //////////

function sendchat($userid,$noidung){
global $JSON;
$payload = '{"'.$JSON.'":"'.$noidung.'"}';
request($userid,$payload);		
}

function endchat($userid,$noidung){
global $JSON;
$payload = '{"'.$JSON.'":"'.$noidung.'","chat":"off"}';
request($userid,$payload);		
}

function outchat($userid) {
  global $conn;
  $partner = getRelationship($userid);
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 0, `ketnoi` = NULL, `hangcho` = 0 WHERE `ID` = $userid");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 0, `ketnoi` = NULL, `hangcho` = 0 WHERE `ID` = $partner");
  sendchat($userid,"💔 Bạn đã dừng chát ! Để tiếp tục hãy gõ 'Start'");
  endchat($partner,"💔 Người lạ đã rời chát ! Để tiếp tục hãy gõ 'Start'");
}


function hangcho($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `hangcho` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['hangcho']) !== 0;
}

function trangthai($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `trangthai` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['trangthai']) !== 0;
}


if (!trangthai($ID)){ // nếu chưa chát
if (!hangcho($ID)) { // nếu không ở trong hàng chờ

echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"⛔️ CẢNH BÁO",
              "subtitle":"Bạn chưa bắt đầu cuộc trò chuyện ! Hãy gõ \'Start\' bắt đầu cuộc trò chuyện"
            }
          ]
        }
      }
    }
  ]
}'; 	   	
}else{ // nếu đang ở trong hàng chờ
echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"📣 THÔNG BÁO",
              "subtitle":"Bạn đã rời khỏi hàng chờ ! Hãy gõ \'Start\' để quay lại hàng chờ"
            }
          ]
        }
      }
    }
  ]
}';
mysqli_query($conn, "UPDATE `users` SET `hangcho` = 0 WHERE `ID` = $ID");
}
}else{
// nếu đang chát
//giải quyết sau
outchat($ID);
}
mysqli_close($conn);
?>