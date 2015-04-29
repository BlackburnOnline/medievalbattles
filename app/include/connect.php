<?php

$dbnam = "mbv6";
$var = mysql_connect("127.0.0.1", "mb", "mb") or die('Could not connect: ' . mysql_error());
mysql_select_db($dbnam) or die(mysql_error());

//mysql_connect (localhost, root) or die(mysql_error());
//mysql_select_db(mbv6) or die(mysql_error());
//$dbnam = "mbv6";
//$var = @mysql_connect(localhost, root) or die();

?>
