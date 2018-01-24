<?
define ('HOST','localhost');
define ('USER','Igor');
define ('PASS','1234');
define ('DB','1');

$Connect = mysqli_connect(HOST, USER, PASS, DB);


var_dump($Connect);



?>