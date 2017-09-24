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
$sql = "SELECT * FROM users WHERE LOWER(npHandle) = LOWER('$npHandle') LIMIT 1";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $profileHandle     = $row['npHandle'];
      $profileBiography  = $row['biography'];
      $profileHeartCount = $row['heartCount'];
	  $profileFavouriteUserCount = $row['favouriteUserCount'];
	  $profileCommentCount = $row['commentCount'];
    }
  }else{
  require_once('../404.shtml.php');die();
}
?>
<user type="user">
  <npHandle><?php echo($profileHandle);?></npHandle>
  <game>1</game>
  <lbp1UsedSlots>0</lbp1UsedSlots>
  <entitledSlots>0</entitledSlots>
  <freeSlots>20</freeSlots>
  <crossControlUsedSlots>0</crossControlUsedSlots>
  <crossControlEntitledSlots>20</crossControlEntitledSlots>
  <crossControlPurchsedSlots>0</crossControlPurchsedSlots>
  <crossControlFreeSlots>20</crossControlFreeSlots>
  <lbp2UsedSlots>0</lbp2UsedSlots>
  <lbp2EntitledSlots>20</lbp2EntitledSlots>
  <lbp2PurchasedSlots>0</lbp2PurchasedSlots>
  <lbp2FreeSlots>20</lbp2FreeSlots>
  <lbp3UsedSlots>0</lbp3UsedSlots>
  <lbp3EntitledSlots>0</lbp3EntitledSlots>
  <lbp3PurchasedSlots>0</lbp3PurchasedSlots>
  <lbp3FreeSlots>0</lbp3FreeSlots>
  <lists>0</lists>
  <lists_quota>20</lists_quota>
  <heartCount><?php echo($profileHeartCount);?></heartCount>
  <planets/>
  <yay2/>
  <boo2/>
  <biography><?php echo($profileBiography);?></biography>
  <reviewCount>0</reviewCount>
  <commentCount><?php echo($profileCommentCount);?></commentCount>
  <photosByMeCount>0</photosByMeCount>
  <photosWithMeCount>0</photosWithMeCount>
  <commentsEnabled>true</commentsEnabled>
  <location>
    <x>3065</x>
    <y>15606</y>
  </location>
  <favouriteSlotCount>0</favouriteSlotCount>
  <favouriteUserCount><?php echo($profileFavouriteUserCount);?></favouriteUserCount>
  <lolcatftwCount>0</lolcatftwCount>
  <staffChallengeGoldCount>0</staffChallengeGoldCount>
  <staffChallengeSilverCount>0</staffChallengeSilverCount>
  <staffChallengeBronzeCount>0</staffChallengeBronzeCount>
  <clientsConnected>
    <lbp1>true</lbp1>
    <lbp2>true</lbp2>
    <lbpme>true</lbpme>
  </clientsConnected>
</user>