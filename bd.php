<?php
header("Content-type: text/html; charset=utf-8");
$db = mysql_connect ("localhost","user","1234");
mysql_select_db ("1",$db);
mysql_query("SET NAMES utf8");
?>