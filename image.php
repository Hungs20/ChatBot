
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
	
    <title>Image UETChatBot</title>
  </head>
  <body>
    <h1>Images of UETChatBot!</h1>
	<div class="row">
  <div class="col-md-12">

    <div id="mdb-lightbox-ui"></div>

    <div class="mdb-lightbox no-margin ">
<?php

require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$sql = "SELECT * FROM data ORDER BY id DESC";
$result = mysqli_query($conn,$sql );
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		echo '<figure class="col-md-4">';
        if($row['type'] == 'image') echo '<a href="'.$row["text"].'" data-size="1600x1067"><img src = "'.$row["text"].'" class="img-fluid" alt = "'.$row["userID"].'"/></a>';
		else if($row['type'] == 'video') echo '<a href="'.$row["text"].'" data-size="1600x1067"><video class="img-fluid" controls>  <source src="'.$row["text"].'" type="video/mp4"></video></a>';
		else if($row['type'] == 'audio') echo '<a href="'.$row["text"].'" data-size="1600x1067"><audio  controls>  <source src="'.$row["text"].'" type="audio/mp3"></audio></a>';
		echo '</figure>';
    }
} else {
    echo "0 results";
}

mysqli_close($conn);

?>
</div>
</div>
</div>
<!-- Grid row -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/mdb.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/lightbox.js"></script>
	<script> // MDB Lightbox Init
$(function () {
$("#mdb-lightbox-ui").load("mdb-lightbox-ui.html");
});</script>
  </body>
</html>
