<?php
//cybercrime@null.net

$encrtext = 'Текст, который нужно РАСШИФРОВАТЬ | или результат шифрования. Text that must be decrypted | or encryption result';
$decrtext = 'Текст, который нужно ЗАШИФРОВАТЬ | или результат расшифровки. Text that must be encrypted | or decryption result';
$style1 = '';
$style2 = '';
$encrypted = $encrtext;
$decrypted = $decrtext;
$examplepass = 'password123';
$examplesalt = 'RDV070890';


function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
} 

///////////////// Функция зашифровки и расшифровки /////////////////

function strcode($str, $passw="")
{
   $salt = $_POST['salt'];
   $len = strlen($str);
   $gamma = '';
   $n = $len>100 ? 8 : 2;
   while( strlen($gamma)<$len )
   {
      $gamma .= substr(pack('H*', sha1($passw.$gamma.$salt)), 0, $n);
   }
   return $str^$gamma;
}


////////////////// Pressing the button "Encrypt" //////////////////

if(isset($_POST['submit_encrypt']))
{

//////////////////////////// Encoding /////////////////////////////

if ($_POST['encryptedtext'] == $encrtext) 
{
	$decrypted =  $decrtext;
}
else 
{
$txt2 = strcode(base64url_decode($_POST['encryptedtext']), $_POST['pass']);
$decrypted = $txt2;
$encrypted =  $_POST['encryptedtext'];
$style1 = 'background-color: rgb(105, 234, 170)';
}
if ($_POST['pass'] !== 'password123'){
	$examplepass = $_POST['pass'];
}
if($_POST['salt'] !== 'RDV070890'){
	$examplesalt = $_POST['salt'];
}
}


////////////////// Pressing the button "Decrypt" //////////////////

if(isset($_POST['submit_decrypt']))
{
//////////////////////////// Decoding /////////////////////////////

if ($_POST['decryptedtext'] == $decrtext) 
{
	$encrypted = $encrtext;
}
else 
{
$txt = base64url_encode(strcode($_POST['decryptedtext'], $_POST['pass']));
$encrypted = $txt;
$decrypted = $_POST['decryptedtext'];
$style2 = 'background-color: rgb(105, 234, 170)';
}
if ($_POST['pass'] !== 'password123'){
	$examplepass = $_POST['pass'];
}
if($_POST['salt'] !== 'RDV070890'){
	$examplesalt = $_POST['salt'];
}
}

ob_start();
?>

<html>
	<head>
	<meta charset="utf-8">
	<title>Crypt / DeCrypt text</title>
	</head>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
td{text-align:center}
pre{
  font-family: Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif;
  margin-bottom: 10px;
  overflow: auto;
  width: auto;
  padding: 5px;
  background-color: #eee;
  width: 650px!ie7;
  padding-bottom: 20px!ie7;
  max-height: 600px;
}
</style>
	<body>

	<h1>Зашифровать или расшифровать текст для использования в PHP</h1>
		<form method="post" action="">
<table class="tg" style="width:100%">
  <tr>
    <th class="tg-s6z2" rowspan="2">
		<p>Пароль / Password: </p><input type="text" name="pass" value="<?php echo $examplepass ?>" onfocus="if(this.value=='password123')this.value=''" onblur="if(this.value=='')this.value='password123'">
		<p>Salt пароля / Password salt: </p><input type="text" name="salt" value="<?php echo $examplesalt ?>" onfocus="if(this.value=='RDV070890')this.value=''" onblur="if(this.value=='')this.value='RDV070890'"></th>
    <th class="tg-yw4l">
		<p>Результат шифрования / Encrypted result</p>
		<textarea style="<?php echo $style2 ?>" name="encryptedtext" cols="70" rows="10" onfocus="if(this.value=='<?php echo $encrtext ?>')this.value=''" onblur="if(this.value==''){this.value='<?php echo $encrtext ?>';this.style.color='#000';this.style.backgroundColor=''}"><?php echo $encrypted?></textarea></th>
    <th class="tg-yw4l">
		<input name="submit_encrypt" id="submit_encrypt" type="submit" value="Расшифровать/Decrypt"></th>
  </tr>
  <tr>
		<td class="tg-yw4l">
		<p>Результат расшифровки / Decrypted result</p>
		<textarea style="<?php echo $style1 ?>" name="decryptedtext" cols="70" rows="10" onfocus="if(this.value=='<?php echo $decrtext ?>')this.value=''" onblur="if(this.value==''){this.value='<?php echo $decrtext ?>';this.style.color='#000';this.style.backgroundColor=''}"><?php echo $decrypted?></textarea></td>
    <td class="tg-yw4l">
		<input name="submit_decrypt" id="submit_decrypt" type="submit" value="Зашифровать/Encrypt"></td>
  </tr>
</table>
		</form>
<?php

ob_end_flush();

?>

<!-------------------------------------------------------------------------------------------------------------->
<!-----------------------------------------Source code example-------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------->
<style>
pre {
    background: #141414;
    word-wrap: break-word;
    margin: 0px;
    padding: 10px;
    color: #F8F8F8;
    font-size: 14px;
    margin-bottom: 20px;
}

pre, code {
    font-family: 'Monaco', courier, monospace;
}

pre .comment {
    color: #5F5A60;
}

pre .constant {
    color: #889AB4;
}

pre .constant.language {
    color: #D87D50;
}

pre .string {
    color: #8F9D6A;
}

pre .selector{
    color: #CDA869;
}

pre .variable {
    color: #7587A6;
}

pre .function {
    color: #9B703F;
}
</style>

<br><br><br>
<center><h2>Исходный код этого скрипта / Source of this script</h2></center>

  <pre>
    <code>	
<span class="constant language">&#x3C;?php</span>
<span class="comment">//My first PHP script. RDV 08 July 1990 from Serishevo.</span>
<span class="variable">$encrtext</span> = <span class="string">&#x27;&#x422;&#x435;&#x43A;&#x441;&#x442;, &#x43A;&#x43E;&#x442;&#x43E;&#x440;&#x44B;&#x439; &#x43D;&#x443;&#x436;&#x43D;&#x43E; &#x420;&#x410;&#x421;&#x428;&#x418;&#x424;&#x420;&#x41E;&#x412;&#x410;&#x422;&#x42C; | &#x438;&#x43B;&#x438; &#x440;&#x435;&#x437;&#x443;&#x43B;&#x44C;&#x442;&#x430;&#x442; &#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x430;&#x43D;&#x438;&#x44F;. Text that must be decrypted | or encryption result&#x27;</span>;
<span class="variable">$decrtext</span> = <span class="string">&#x27;&#x422;&#x435;&#x43A;&#x441;&#x442;, &#x43A;&#x43E;&#x442;&#x43E;&#x440;&#x44B;&#x439; &#x43D;&#x443;&#x436;&#x43D;&#x43E; &#x417;&#x410;&#x428;&#x418;&#x424;&#x420;&#x41E;&#x412;&#x410;&#x422;&#x42C; | &#x438;&#x43B;&#x438; &#x440;&#x435;&#x437;&#x443;&#x43B;&#x44C;&#x442;&#x430;&#x442; &#x440;&#x430;&#x441;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x43A;&#x438;. Text that must be encrypted | or decryption result&#x27;</span>;
<span class="variable">$style1</span> = <span class="string">&#x27;&#x27;</span>;
<span class="variable">$style2</span> = <span class="string">&#x27;&#x27;</span>;
<span class="variable">$encrypted</span> = <span class="variable">$encrtext</span>;
<span class="variable">$decrypted</span> = <span class="variable">$decrtext</span>;
<span class="variable">$examplepass = 'password123'</span>;
<span class="variable">$examplesalt = 'RDV070890'</span>;

function <span class="function">base64url_encode</span>(<span class="variable">$data</span>) {
  return rtrim(strtr(base64_encode(<span class="variable">$data</span>), <span class="string">'+/'</span>, <span class="string">'-_'</span>), <span class="string">'='</span>);
}

function <span class="function">base64url_decode</span>(<span class="variable">$data</span>) {
  return base64_decode(str_pad(strtr(<span class="variable">$data</span>, <span class="string">'-_'</span>, <span class="string">'+/'</span>), strlen(<span class="variable">$data</span>) % 4, <span class="string">'='</span>, STR_PAD_RIGHT));
} 

<span class="comment">///////////////// &#x424;&#x443;&#x43D;&#x43A;&#x446;&#x438;&#x44F; &#x437;&#x430;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x43A;&#x438; &#x438; &#x440;&#x430;&#x441;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x43A;&#x438; /////////////////</span>

function <span class="function">strcode</span>(<span class="variable">$str</span>, <span class="variable">$passw</span>=<span class="string">&#x22;&#x22;</span>)
{
   <span class="variable">$salt</span> = <span class="variable">$_POST</span>[<span class="string">&#x27;salt&#x27;</span>];
   <span class="variable">$len</span> = strlen(<span class="variable">$str</span>);
   <span class="variable">$gamma</span> = <span class="string">&#x27;&#x27;</span>;
   <span class="variable">$n</span> = <span class="variable">$len</span>&#x3E;100 ? 8 : 2;
   while( strlen(<span class="variable">$gamma</span>)&#x3C;<span class="variable">$len</span> )
   {
      <span class="variable">$gamma</span> .= substr(pack(<span class="string">&#x27;H*&#x27;</span>, sha1(<span class="variable">$passw</span>.<span class="variable">$gamma</span>.<span class="variable">$salt</span>)), 0, <span class="variable">$n</span>);
   }
   return <span class="variable">$str</span>^<span class="variable">$gamma</span>;
}


<span class="comment">////////////////// Pressing the button &#x22;Encrypt&#x22; //////////////////</span>

<span class="selector">if</span>(isset(<span class="variable">$_POST</span>[<span class="string">&#x27;submit_encrypt&#x27;</span>]))
{

<span class="comment">//////////////////////////// Encoding /////////////////////////////</span>

<span class="selector">if</span> (<span class="variable">$_POST</span>[<span class="string">&#x27;encryptedtext&#x27;</span>] == <span class="variable">$encrtext</span>) 
{
&#x9;<span class="variable">$decrypted</span> =  <span class="variable">$decrtext</span>;
}
<span class="selector">else</span> 
{
<span class="variable">$txt2</span> = <span class="function">strcode</span>(base64url_decode(<span class="variable">$_POST</span>[<span class="string">&#x27;encryptedtext&#x27;</span>]), <span class="variable">$_POST</span>[<span class="string">&#x27;pass&#x27;</span>]);
<span class="variable">$decrypted</span> = <span class="variable">$txt2</span>;
<span class="variable">$encrypted</span> =  <span class="variable">$_POST</span>[<span class="string">&#x27;encryptedtext&#x27;</span>];
<span class="variable">$style1</span> = <span class="string">&#x27;background-color: rgb(105, 234, 170)&#x27;</span>;
}

<span class="selector">if</span> (<span class="variable">$_POST</span>[<span class="string">'pass'</span>] !== <span class="string">'password123'</span>){
	<span class="variable">$examplepass</span> = <span class="variable">$_POST</span>[<span class="string">'pass'</span>];
}
<span class="selector">if</span> (<span class="variable">$_POST</span>[<span class="string">'salt'</span>] !== <span class="string">'RDV070890'</span>){
	<span class="variable">$examplesalt</span> = <span class="variable">$_POST</span>[<span class="string">'salt'</span>];
}
}


<span class="comment">////////////////// Pressing the button &#x22;Decrypt&#x22; //////////////////</span>

<span class="selector">if</span>(isset(<span class="variable">$_POST</span>[<span class="string">&#x27;submit_decrypt&#x27;</span>]))
{
<span class="comment">//////////////////////////// Decoding /////////////////////////////</span>

<span class="selector">if</span> (<span class="variable">$_POST</span>[<span class="string">&#x27;decryptedtext&#x27;</span>] == <span class="variable">$decrtext</span>) 
{
&#x9;<span class="variable">$encrypted</span> = <span class="variable">$encrtext</span>;
}
<span class="selector">else </span>
{
<span class="variable">$txt</span> = base64url_encode(<span class="function">strcode</span>(<span class="variable">$_POST</span>[<span class="string">&#x27;decryptedtext&#x27;</span>], <span class="variable">$_POST</span>[<span class="string">&#x27;pass&#x27;</span>]));
<span class="variable">$encrypted</span> = <span class="variable">$txt</span>;
<span class="variable">$decrypted</span> = <span class="variable">$_POST</span>[<span class="string">&#x27;decryptedtext&#x27;</span>];
<span class="variable">$style2</span> = <span class="string">&#x27;background-color: rgb(105, 234, 170)&#x27;</span>;
}

<span class="selector">if</span> (<span class="variable">$_POST</span>[<span class="string">'pass'</span>] !== <span class="string">'password123'</span>){
	<span class="variable">$examplepass</span> = <span class="variable">$_POST</span>[<span class="string">'pass'</span>];
}
<span class="selector">if</span> (<span class="variable">$_POST</span>[<span class="string">'salt'</span>] !== <span class="string">'RDV070890'</span>){
	<span class="variable">$examplesalt</span> = <span class="variable">$_POST</span>[<span class="string">'salt'</span>];
}
}

<span class="function">ob_start();</span>
<span class="constant language">?&#x3E;</span>

&#x3C;html&#x3E;
&#x9;&#x3C;head&#x3E;
&#x3C;meta charset="utf-8"&#x3E;
&#x9;&#x3C;title&#x3E;Crypt / DeCrypt text&#x3C;/title&#x3E;
&#x9;&#x3C;/head&#x3E;

&#x3C;style type=&#x22;text/css&#x22;&#x3E;
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
td{text-align:center}
&#x3C;/style&#x3E;

&#x9;&#x3C;body&#x3E;
&#x9;&#x3C;h1&#x3E;&#x417;&#x430;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x430;&#x442;&#x44C; &#x438;&#x43B;&#x438; &#x440;&#x430;&#x441;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x430;&#x442;&#x44C; &#x442;&#x435;&#x43A;&#x441;&#x442; &#x434;&#x43B;&#x44F; &#x438;&#x441;&#x43F;&#x43E;&#x43B;&#x44C;&#x437;&#x43E;&#x432;&#x430;&#x43D;&#x438;&#x44F; &#x432; PHP&#x3C;/h1&#x3E;
&#x9;&#x9;&#x3C;form method=&#x22;post&#x22; action=&#x22;&#x22;&#x3E;
&#x3C;table class=&#x22;tg&#x22; style=&#x22;width:100%&#x22;&#x3E;
&#x9;&#x3C;tr&#x3E;
&#x9;&#x9;&#x3C;th class=&#x22;tg-s6z2&#x22; rowspan=&#x22;2&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;p&#x3E;&#x41F;&#x430;&#x440;&#x43E;&#x43B;&#x44C; / Password: &#x3C;/p&#x3E;&#x3C;input type=&#x22;text&#x22; name=&#x22;pass&#x22; value=&#x22;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$examplepass</span> <span class="constant language">?&#x3E;</span>&#x22; onfocus=&#x22;if(this.value==&#x27;password123&#x27;)this.value=&#x27;&#x27;&#x22; onblur=&#x22;if(this.value==&#x27;&#x27;)this.value=&#x27;password123&#x27;&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;p&#x3E;Salt &#x43F;&#x430;&#x440;&#x43E;&#x43B;&#x44F; / Password salt: &#x3C;/p&#x3E;&#x3C;input type=&#x22;text&#x22; name=&#x22;salt&#x22; value=&#x22;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$examplesalt</span> <span class="constant language">?&#x3E;</span>&#x22; onfocus=&#x22;if(this.value==&#x27;RDV070890&#x27;)this.value=&#x27;&#x27;&#x22; onblur=&#x22;if(this.value==&#x27;&#x27;)this.value=&#x27;RDV070890&#x27;&#x22;&#x3E;&#x3C;/th&#x3E;
&#x9;&#x9;&#x3C;th class=&#x22;tg-yw4l&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;p&#x3E;&#x420;&#x435;&#x437;&#x443;&#x43B;&#x44C;&#x442;&#x430;&#x442; &#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x430;&#x43D;&#x438;&#x44F; / Encrypted result&#x3C;/p&#x3E;
&#x9;&#x9;&#x9;&#x3C;textarea style=&#x22;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$style2</span> <span class="constant language">?&#x3E;</span>&#x22; name=&#x22;encryptedtext&#x22; cols=&#x22;70&#x22; rows=&#x22;10&#x22; onfocus=&#x22;if(this.value==&#x27;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$encrtext</span> <span class="constant language">?&#x3E;</span>&#x27;)this.value=&#x27;&#x27;&#x22; onblur=&#x22;if(this.value==&#x27;&#x27;){this.value=&#x27;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$encrtext</span> <span class="constant language">?&#x3E;</span>&#x27;;this.style.color=&#x27;#000&#x27;;this.style.backgroundColor=&#x27;&#x27;}&#x22;&#x3E;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$encrypted</span> <span class="constant language">?&#x3E;</span>&#x3C;/textarea&#x3E;&#x3C;/th&#x3E;
&#x9;&#x9;&#x3C;th class=&#x22;tg-yw4l&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;input name=&#x22;submit_encrypt&#x22; id=&#x22;submit_encrypt&#x22; type=&#x22;submit&#x22; value=&#x22;&#x420;&#x430;&#x441;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x430;&#x442;&#x44C;/Decrypt&#x22;&#x3E;&#x3C;/th&#x3E;
&#x9;&#x3C;/tr&#x3E;
&#x9;&#x3C;tr&#x3E;
&#x9;&#x9;&#x3C;td class=&#x22;tg-yw4l&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;p&#x3E;&#x420;&#x435;&#x437;&#x443;&#x43B;&#x44C;&#x442;&#x430;&#x442; &#x440;&#x430;&#x441;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x43A;&#x438; / Decrypted result&#x3C;/p&#x3E;
&#x9;&#x9;&#x9;&#x3C;textarea style=&#x22;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$style1</span> <span class="constant language">?&#x3E;</span>&#x22; name=&#x22;decryptedtext&#x22; cols=&#x22;70&#x22; rows=&#x22;10&#x22; onfocus=&#x22;if(this.value==&#x27;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$decrtext</span> <span class="constant language">?&#x3E;</span>&#x27;)this.value=&#x27;&#x27;&#x22; onblur=&#x22;if(this.value==&#x27;&#x27;){this.value=&#x27;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$decrtext</span> <span class="constant language">?&#x3E;</span>&#x27;;this.style.color=&#x27;#000&#x27;;this.style.backgroundColor=&#x27;&#x27;}&#x22;&#x3E;<span class="constant language">&#x3C;?php</span> <span class="constant">echo</span> <span class="variable">$decrypted</span> <span class="constant language">?&#x3E;</span>&#x3C;/textarea&#x3E;&#x3C;/td&#x3E;
&#x9;&#x9;&#x3C;td class=&#x22;tg-yw4l&#x22;&#x3E;
&#x9;&#x9;&#x9;&#x3C;input name=&#x22;submit_decrypt&#x22; id=&#x22;submit_decrypt&#x22; type=&#x22;submit&#x22; value=&#x22;&#x417;&#x430;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x430;&#x442;&#x44C;/Encrypt&#x22;&#x3E;&#x3C;/td&#x3E;
&#x9;&#x3C;/tr&#x3E;
&#x9;&#x3C;/table&#x3E;
&#x9;&#x3C;/form&#x3E;
&#x3C;/body&#x3E;
&#x3C;/html&#x3E;

<span class="constant language">&#x3C;?php</span>

<span class="function">ob_end_flush();</span>

<span class="constant language">?&#x3E;</span>
		</pre>
    </code>
    <br><br><br>
<center><h2> Пример использования / Example of use</h2></center>

  <pre>
    <code>	
&#x3C;?php

function strcode($str, $passw=&#x22;&#x22;)
{
   $salt = &#x22;RDV070890&#x22;;
   $len = strlen($str);
   $gamma = &#x27;&#x27;;
   $n = $len&#x3E;100 ? 8 : 2;
   while( strlen($gamma)&#x3C;$len )
   {
      $gamma .= substr(pack(&#x27;H*&#x27;, sha1($passw.$gamma.$salt)), 0, $n);
   }
   return $str^$gamma;
}

/*&#x417;&#x434;&#x435;&#x441;&#x44C; &#x437;&#x430;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x430;&#x43D;&#x430; &#x441;&#x441;&#x44B;&#x43B;&#x43A;&#x430; &#x434;&#x43B;&#x44F; &#x440;&#x435;&#x434;&#x438;&#x440;&#x435;&#x43A;&#x442;&#x430; / here is encrypted a link for redirect */
$data2 = &#x22;UJxclTltc1/EdOJppPFwhXD2UFV2qVVGS6CSHVU1w8iE1gCmct0vPSNpFttBTKGUiTdk6oo7d3OE5rHuUW8CNBYTmAHB4Ga6QelvuWUhgw==&#x22;;
$data2 = strcode(base64url_decode($data2), $_GET[&#x27;q&#x27;]);


if($_GET[&#x27;q2&#x27;] === &#x27;redirect&#x27;){
header($data2);
exit();
}
else {
header(&#x27;Location: https://www.google.com/search?q=viagra+wiki&#x27;);
}

?&#x3E;

&#x3C;!-- 
&#x412; &#x44D;&#x442;&#x43E;&#x43C; &#x43F;&#x440;&#x438;&#x43C;&#x435;&#x440;&#x435;, &#x435;&#x441;&#x43B;&#x438; &#x43A;&#x442;&#x43E;-&#x442;&#x43E; &#x437;&#x430;&#x439;&#x434;&#x435;&#x442; &#x43D;&#x430; &#x43D;&#x430;&#x448;&#x443; &#x441;&#x442;&#x440;&#x430;&#x43D;&#x438;&#x446;&#x443; &#x441; &#x43F;&#x430;&#x440;&#x430;&#x43C;&#x435;&#x442;&#x440;&#x430;&#x43C;&#x438; &#x22;site.com/script.php?q=password&#x26;q2=redirect&#x22;,
&#x442;&#x43E;&#x433;&#x434;&#x430; &#x435;&#x433;&#x43E; &#x43F;&#x435;&#x440;&#x435;&#x430;&#x434;&#x440;&#x435;&#x441;&#x443;&#x435;&#x442; &#x43F;&#x43E; &#x430;&#x434;&#x440;&#x435;&#x441;&#x443;, &#x43A;&#x43E;&#x442;&#x43E;&#x440;&#x44B;&#x439; &#x437;&#x430;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x430;&#x43D; &#x432; &#x43F;&#x435;&#x440;&#x435;&#x43C;&#x435;&#x43D;&#x43D;&#x43E;&#x439; &#x22;$data2&#x22;. &#x410; &#x43F;&#x430;&#x440;&#x43E;&#x43B;&#x44C; &#x434;&#x43B;&#x44F; &#x440;&#x430;&#x441;&#x448;&#x438;&#x444;&#x440;&#x43E;&#x432;&#x43A;&#x438; &#x441;&#x43A;&#x440;&#x438;&#x43F;&#x442; &#x432;&#x43E;&#x437;&#x44C;&#x43C;&#x435;&#x442;
&#x438;&#x437; &#x43F;&#x430;&#x440;&#x430;&#x43C;&#x435;&#x442;&#x440;&#x430; q &#x43A;&#x43E;&#x442;&#x43E;&#x440;&#x44B;&#x439; &#x43C;&#x44B; &#x443;&#x43A;&#x430;&#x436;&#x435;&#x43C; &#x432; &#x441;&#x441;&#x44B;&#x43B;&#x43A;&#x435;. &#x41F;&#x430;&#x440;&#x430;&#x43C;&#x435;&#x442;&#x440; &#x22;q2&#x22; &#x43F;&#x440;&#x43E;&#x441;&#x442;&#x43E; &#x434;&#x43B;&#x44F; &#x43E;&#x43F;&#x440;&#x435;&#x434;&#x435;&#x43B;&#x435;&#x43D;&#x438;&#x44F; &#x434;&#x435;&#x439;&#x441;&#x442;&#x432;&#x438;&#x44F;.
---------------------------------------------------------
In this example, everyone who go on this page with parameters &#x22;site.com/script.php?q=password&#x26;q2=redirect&#x22;,
will be redirected to address that encrypted in variable &#x22;$data2&#x22;. Decryption password script will get from 
parameter &#x22;q&#x22; that we will notice in link. Parameter &#x22;q2&#x22; is just for determining of action.
--&#x3E;

    </pre>
    </code>
	</body>
</html>
