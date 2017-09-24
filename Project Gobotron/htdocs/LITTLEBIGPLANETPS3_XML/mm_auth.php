<?php
$getCookie = $_COOKIE['MM_AUTH'];
//We don't need to check if the cookie is valid or not right now
//Add in security later in development.
$authName  = strrev(hex2bin(substr($getCookie, 0, strpos($getCookie, ":"))));
?>