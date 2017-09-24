<?php
require_once('../mm_auth.php');
header('Content-Type: text/xml');
$conn = new mysqli('localhost', 'root', '', 'lbpserver');
if($conn->connect_error) {
  require_once('../403.shtml.php');die();
}
if(isset($_GET['u'])&&!empty($_GET['u'])){
  $userProfile = htmlentities($_GET['u'],ENT_QUOTES);
}else{
  require_once('../404.shtml.php');die();
}
if(isset($_GET['commentId'])&&!empty($_GET['commentId'])){
  $commentId = htmlentities($_GET['commentId'],ENT_QUOTES);
  if(!ctype_digit(strval($commentId))){
    require_once('../404.shtml.php');die();
  }
}else{
  require_once('../404.shtml.php');die();
}
$sql = "SELECT * FROM `usercomments` WHERE foruser='$userProfile' AND index_id='$commentId' LIMIT 1";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $commentOwner = $row['npHandle'];
      if($authName==$userProfile){
        $deletedTypeOf = 'user';
      }else if($commentOwner==$authName){
        $deletedTypeOf = 'author';
      }else{
        $deletedTypeOf = 'moderated';
      }
    }
  }else{
    require_once('../404.shtml.php');die();
}
$sql = "UPDATE `usercomments` 
        SET deleted    ='true',
            deletedBy  ='$authName',
            deletedType='$deletedTypeOf'
        WHERE foruser='$userProfile' AND index_id ='$commentId'";
$conn->query($sql);
$conn->close();
?>