<?php
header('Content-Type: text/xml');
$conn = new mysqli('localhost', 'root', '', 'lbpserver');
if($conn->connect_error) {
  require_once('403.shtml.php');die();
  die();
}
if(isset($_GET['u'])&&!empty($_GET['u'])){
  $npHandle = htmlentities($_GET['u'],ENT_QUOTES);
}else{
  require_once('../404.shtml.php');die();
}
$sql = "SELECT * FROM userComments WHERE LOWER(foruser) = LOWER('$npHandle')";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $index_id     = array();
    $npHandle     = array();
    $timestamp    = array();
    $message      = array();
    $thumbsup     = array();
    $thumbsdown   = array();
    $yourthumb    = array();
    $commentCount = -1;
    while($row = $result->fetch_assoc()){
      array_push($index_id,$row['index_id']);
      array_push($npHandle,$row['npHandle']);
      array_push($timestamp,$row['timestamp']);
      array_push($message,$row['message']);
      array_push($thumbsup,$row['thumbsup']);
      array_push($thumbsdown,$row['thumbsdown']);
      array_push($yourthumb,$row['yourthumb']);
      $commentCount = $commentCount + 1;
    }
  }else{
  require_once('../404.shtml.php');die();
}
?>
<comments>
<?php
for ($x = 0; $x <= $commentCount; $x++) {
  echo "  <comment>\r\n";
  echo '    <id>'.$index_id[$x]."</id>\r\n";
  echo '    <npHandle>'.$npHandle[$x]."</npHandle>\r\n";
  echo '    <timestamp>'.$timestamp[$x]."</timestamp>\r\n";
  echo '    <message>'.$message[$x]."</message>\r\n";
  echo '    <thumbsup>'.$thumbsup[$x]."</thumbsup>\r\n";
  echo '    <thumbsdown>'.$thumbsdown[$x]."</thumbsdown>\r\n";
  echo '    <yourthumb>'.$yourthumb[$x]."</yourthumb>\r\n";
  echo "  </comment>\r\n";
}
?>
</comments>