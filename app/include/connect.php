<?php

$dbnam = "mbv6";
$db = mysqli_connect("127.0.0.1", "mb", "mb", $dbnam);

if (!$db) {
  echo "Error: Unable to connect to database." . PHP_EOL;
  echo mysqli_connect_error() . PHP_EOL;
  exit;
}

?>
