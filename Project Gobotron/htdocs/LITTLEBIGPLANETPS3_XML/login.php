<?php
header('Content-Type: text/xml');
$conn = new mysqli('localhost', 'root', '', 'lbpserver');
if($conn->connect_error) {
  require_once('403.shtml.php');die();
  die();
}
$postPayload = bin2hex(file_get_contents('php://input'));
$unsafeChars = array("\x00","\x07","\x0C","\x0A","\x0D","\x09");
$npHandle    = str_replace($unsafeChars,'',hex2bin(substr($postPayload,168,64)));
$npLang      = str_replace($unsafeChars,'',hex2bin(substr($postPayload,240,4)));
$npTITLE_ID  = str_replace($unsafeChars,'',hex2bin(substr($postPayload,286,18)));
if(isset($_GET['titleID'])&&!empty($_GET['titleID'])){
  if($npTITLE_ID!==$_GET['titleID']){
    require_once('403.shtml.php');die();
  }
}else{
  require_once('403.shtml.php');die();
}
$preTicket   = bin2hex(strrev($npHandle)).':0:'.$npLang.':'.bin2hex(strrev($npTITLE_ID));
$tokenAuth   = hash_hmac('sha1',$preTicket,'89543337c978b127a6899c68f64f04a7');
$authTicket  = $preTicket.':'.$tokenAuth;
setcookie('MM_AUTH',$authTicket);
$sql = "SELECT * FROM users WHERE LOWER(npHandle) = LOWER('$npHandle') LIMIT 1";
$result = $conn->query($sql);
if($result->num_rows > 0){}else{
  $sql = "INSERT INTO `users` (`npHandle`, `biography`, `heartCount`,`Id`) VALUES ('$npHandle', '', 0, NULL)";
  $result = $conn->query($sql);
}
$conn->close();
?>
<authTicket>MM_AUTH=<?php echo($authTicket);?></authTicket><lbpEnvVer>production rLBP_2017_03_21_patch-037-hotfix1</lbpEnvVer><titleStorageURL>https://d2hez144257i1y.cloudfront.net/lbp-title-storage/production/</titleStorageURL>