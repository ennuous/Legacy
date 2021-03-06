<?php
require_once('../mm_auth.php');
header('Content-Type: text/xml');
$conn = new mysqli('localhost', 'root', '', 'lbpserver');
if($conn->connect_error) {
  require_once('../403.shtml.php');die();
}
if(isset($_GET['u'])&&!empty($_GET['u'])){
  $forNpHandle = htmlentities($_GET['u'],ENT_QUOTES);
}else{
  require_once('../404.shtml.php');die();
}
$sql = "SELECT * FROM userComments WHERE LOWER(foruser) = LOWER('$forNpHandle') ORDER BY id desc LIMIT 1";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $nextCommentId = $row['index_id'] + 1;
    }
  }else{
    $nextCommentId = 1;
}
$comment      = simplexml_load_string(file_get_contents('php://input'));
if(empty($comment)){
  require_once('../403.shtml.php');die();
}
$comment      = $comment[0]->message;
if(empty($comment)||$comment==''){
  require_once('../403.shtml.php');die();
}
$comment      = htmlentities($comment, ENT_QUOTES);
$timestampNow = round(microtime(true) * 1000);
$sql = "INSERT INTO `usercomments` 
         (`id`, `npHandle`, `timestamp`, `message`, `thumbsup`, `thumbsdown`, `yourthumb`, `deleted`, `deletedBy`, `deletedType`, `index_id`, `foruser`)
        VALUES 
         (NULL, '$authName', '$timestampNow', '$comment', 0, 0, 0, 'false', '', '', $nextCommentId, '$forNpHandle')";
$conn->query($sql);
$sql = "UPDATE `users` 
        SET commentCount='$nextCommentId'
        WHERE npHandle='$forNpHandle'";
$conn->query($sql);
$conn->close();
?>