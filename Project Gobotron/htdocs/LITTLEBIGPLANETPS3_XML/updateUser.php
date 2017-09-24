<?php
require_once('mm_auth.php');
header('Content-Type: text/xml');
$conn = new mysqli('localhost', 'root', '', 'lbpserver');
if($conn->connect_error) {
  require_once('403.shtml.php');die();
}
$comment      = simplexml_load_string(file_get_contents('php://input'));
if(empty($comment)){
  require_once('403.shtml.php');die();
}
$comment      = $comment[0]->biography;
if(empty($comment)||$comment==""){
  require_once('403.shtml.php');die();
}
$comment      = htmlentities($comment, ENT_QUOTES);
$sql = "UPDATE users SET biography='$comment' WHERE npHandle='$authName'";
$result = $conn->query($sql);
$conn->close();
?>