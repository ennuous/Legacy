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
$sql = "SELECT * FROM userComments WHERE LOWER(foruser) = LOWER('$npHandle') ORDER BY id desc LIMIT 10";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $index_id     = array();
    $npHandle     = array();
    $timestamp    = array();
    $message      = array();
    $thumbsup     = array();
    $thumbsdown   = array();
    $yourthumb    = array();
    $deleted      = array();
    $deletedBy    = array();
    $deletedType  = array();
    $commentCount = -1;
    while($row = $result->fetch_assoc()){
      array_push($index_id,$row['index_id']);
      array_push($npHandle,$row['npHandle']);
      array_push($timestamp,$row['timestamp']);
      array_push($message,$row['message']);
      array_push($thumbsup,$row['thumbsup']);
      array_push($thumbsdown,$row['thumbsdown']);
      array_push($yourthumb,$row['yourthumb']);
      array_push($deleted,$row['deleted']);
      array_push($deletedBy,$row['deletedBy']);
      array_push($deletedType,$row['deletedType']);
      $commentCount = $commentCount + 1;
    }
  }else{
  require_once('../404.shtml.php');die();
}
$conn->close();
?>
<comments>
<?php
for ($x = 0; $x <= $commentCount; $x++) {
  echo "  <comment>\r\n";
  echo '    <id>'.$index_id[$x]."</id>\r\n";
  echo '    <npHandle>'.$npHandle[$x]."</npHandle>\r\n";
  echo '    <timestamp>'.$timestamp[$x]."</timestamp>\r\n";
  if($deleted[$x]=='false'){
    echo '    <message>'.$message[$x]."</message>\r\n";
  }else{
    echo '    <deleted>'.$deleted[$x]."</deleted>\r\n";
    echo '    <deletedBy>'.$deletedBy[$x]."</deletedBy>\r\n";
    echo '    <deletedType>'.$deletedType[$x]."</deletedType>\r\n";
  }
  echo '    <thumbsup>'.$thumbsup[$x]."</thumbsup>\r\n";
  echo '    <thumbsdown>'.$thumbsdown[$x]."</thumbsdown>\r\n";
  echo '    <yourthumb>'.$yourthumb[$x]."</yourthumb>\r\n";
  echo "  </comment>\r\n";
}
?>
</comments>