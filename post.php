<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Europe/Kiev');


session_start(); //запускаем сессию. ќб¤зательно в начале страницы
include ("bd.php"); // соедин¤емс¤ с базой, укажите свой путь, если у вас уже есть соединение

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//если существует логин и пароль в сесси¤х, то провер¤ем, действительны ли они
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //если логин или пароль не действителен
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
   }
}
else {
//ѕровер¤ем, зарегистрирован ли вошедший
exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }

if (isset($_POST['id'])) { $id = $_POST['id'];}//получаем идентификатор страницы получател¤
if (isset($_POST['text'])) { $text = $_POST['text'];}//получаем текст сообщени¤
if (isset($_POST['poluchatel'])) { $poluchatel = $_POST['poluchatel'];}//логин получател¤
$author = $_SESSION['login'];//логин автора
$date = date("Y-m-d");//дата добавлени¤

if (empty($author) or empty($text) or empty($poluchatel) or empty($date)) {//есть ли все необходимые данные? ≈сли нет, то останавливаем
exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля");}

$text = stripslashes($text);//удал¤ем обратные слеши
$text = htmlspecialchars($text);//преобразование спецсимволов в их HTML эквиваленты


$result2 = mysql_query("INSERT INTO messages (author, poluchatel, date, text) VALUES ('$author','$poluchatel','$date','$text')",$db);//заносим в базу сообщение

echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$id."'></head><body>Ваше сообщение передано! Вы будете перемещены через 5 сек. Если не хотите ждать, то <a href='page.php?id=".$id."'>нажмите сюда.</a></body></html>";//перенаправл¤ем пользовател¤
?>