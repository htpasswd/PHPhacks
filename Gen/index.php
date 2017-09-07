<?php
$approvedUsers = array("Demetri");
$anchorGifts = array("<a href='http://giftsreplica.appspot.com/?data=a2CYCC1nGmvUaKgbIYHiavBbazYwug15NmZUZFazPtG-jKuazRoFH71vnKh4YKc3xAj-AmIq3y3uI9aMvIUIP6E3PlElVASqQ'>", "</a>");
$anchorPharm = array("<a href='http://data-id.appspot.com/?data=e4Pc5jBCt2vPZB_etBF3i4oDkLCH4ZnYH4n4uEtKqbfmtDR2xFTrVU9SGR4rwp6Q0ZvCOWjhpM1obzEo9MH5API3WtEIm8'>", "</a>");
$path = getcwd()."/";
$key = null;
$city = null;
$rndKey = null;
$state = null;
$models = null;
$shipping = null;
$modelsFile = null;
$filePath = null;
$lowKeys = null;
$randText = null;
$words1 = null;
$words2 = null;
$checked = null;
$keyBold = null;
$lastFileUpdate = null;
$changesList = null;
$checkbox3Text = 'Добавлять город в "Available models".';
$checkbox3check = 'unchecked';
$commentOn = "";
$commentOff = "";
$enabled = "";
$linksInText = "";
$s = "";
$c = "";
$citiesFile = file($path.'cities.txt');

echo "<!-- By Demetri from Amur. InPaceVenimus. Advena sum ex planeta domum.--> 
<!-- ?login=-->
";

if(isset($_COOKIE['login'])){
	$cookies = $_COOKIE['login'];
}else{
	$cookies = null;
}

if(isset($_POST['checkbox7'])){
  $modelsCounted = $_POST['modelsCount'];
}else{
  $modelsCounted = rand(30,50);
}

if(isset($_POST['checkbox8'])){
  $verbsCounted = $_POST['verbsCount'];
}else{
  $verbsCounted = rand(15,30);
}

if(isset($_GET['login'])){
  setcookie("login",$_GET['login'],time()+36000);
}

//Создание ключевика, на основе выбранного файла ключей.
if(isset($_POST['keysFile'])){
//Если файл ключей по фарме, то проверяем кукиес на наличие логина, которому досутны ключи по фарме.
	if(whichKeys() === "pharm" && cookiesCheck() !== "ok"){
		echo '<center><font color="red">You do not have permissions to do that. </font><a href="javascript:window.location.href=window.location.href">Back</a></center>';
		exit;
	}
//Если выбрана опция создания низкочастотных ключей, то берем ключи из файла в зависимости от тематики в выбраном файле ключевиков.
//Берется случайный файл из папки.
	if (isset($_POST['checkbox2'])){
        //Низкочастотные кеи по сумкам.
		if(whichKeys() === "gifts"){
          $filePath = glob($path."models/*.txt");
          $randFile = array_rand($filePath);

          $f_contents = file($filePath[$randFile]); 
          $key = $f_contents[rand(0, count($f_contents) - 1)];
        }else{
          //Низкочастотные кеи по фарме.
          $f_contents = file("pharm.low.txt"); 
          $key = $f_contents[rand(0, count($f_contents) - 1)];
          /////////////////////////////////////////////////////
        }
	}else{
		    $f_contents = file($_POST['keysFile']); 
        $key = $f_contents[rand(0, count($f_contents) - 1)];
	}

$key = ucfirst($key);

//Берем город и штат для подстановки в ключевик.
    	$f_contents2 = file($path.'cities.txt'); 
    	$key2 = $f_contents2[rand(0, count($f_contents2) - 1)];
		  $city = preg_replace('/(.*)\((.*)\)\n/', '$1', $key2);

    	$state = preg_replace('/(.*)\((.*)\)\n/', '$2', $key2);
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////



// Создание списка случайных ключей на основе основного ключевика по сумкам.
if(whichKeys() === "gifts"){
  if(mb_stristr(" ",$key) == false){
    $compare = explode(" ", $key);
  }else{
    $compare = $key;
  }
  
  //....................Сравниваем каждое слово в ключевике с названиями файлов из папки models.
  $filePath2 = glob($path."models/*.txt");
  for ($j=0; $j<=count($filePath2)-1; $j++){
    for ($x=0; $x<=count($compare)-1; $x++){
      if(mb_stristr($filePath2[$j], $compare[$x]) != false){
        $modelsFile = $filePath2[$j];
        break;
      }elseif(mb_stristr($compare[$x], "sunglasses") != false){
        $modelsFile = $path."models/Sunglasses.txt";
        break;
      }elseif(mb_stristr($compare[$x], "jewelry") != false){
        $modelsFile = $path."models/Gifts.txt";
        break;
      }elseif(mb_stristr($compare[$x], "shoes") != false){
        $modelsFile = $path."models/Shoes.txt";
        break;
      }elseif(mb_stristr($compare[$x], "^lv ") != false){
        $modelsFile = $path."models/Louis Vuitton.txt";
        break;
      }
  }
}
if($modelsFile == null){
  $modelsFile = $path."models/Gifts.txt";
}

$randModelsList = file($modelsFile);


//.......................Если опция ModelsCount больше списка моделей или равна "0", то использовать число строк из списка.
if ($modelsCounted > count($randModelsList) or $modelsCounted === "0"){
	$modelsCount = count($randModelsList);
}else{
	$modelsCount = $modelsCounted;
}


for($i=0; $i<=$modelsCount; $i++){
  $keyM = $randModelsList[rand(0, count($randModelsList) - 1)];
  $keyM = rtrim($keyM);

  $f_contentsM = file($path.'cities.txt'); 
  $keyC = $f_contentsM[rand(0, count($f_contentsM) - 1)];
  if(isset($_POST['checkbox3'])){
  	$cityM = " ".preg_replace('/(.*)\((.*)\)\n/', '$1', $keyC);
  }else{
    $cityM = null;
  }

  if (isset($_POST['checkbox1'])){
    $stateM = " ".preg_replace('/(.*)\((.*)\)\n/', '$2', $keyC);
  }else{
    $stateM = null;
  }


$rndSymbol = array(" ", ", ", ". ");
$symbol = $rndSymbol[mt_rand(0, count($rndSymbol) - 1)];
if($i === $modelsCount)$symbol=".";

  if (substr($models, -2) === ". " or substr($models, -2) == null){
    $models .= ucfirst($keyM.$cityM.$stateM.$symbol);
  } else {
    $models .= $keyM.$cityM.$stateM.$symbol;
  }
}
}
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////






//Создание списка городов и регионов.
	$lines = file_get_contents($path."states/".$state.".txt");
	$lines2 = explode("\n", $lines);
	$result = array_merge($lines2);

	$shuffle = shuffle($result);

	$shipping = join(", ", $result);

	$shipping = str_replace(" ,", ",", $shipping);
	$shipping = str_replace(", ,", ",", $shipping);
	$shipping = str_replace(",,", ",", $shipping);
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////




//Создание списка случайного текста со случайными ключевиками из файла
$keywordsFile = file($_POST['keysFile']);

//.......................Если опция verbsCount больше списка ключевиков или равна "0", то использовать число строк из списка.
if ($verbsCounted > count($keywordsFile) or $verbsCounted === "0"){
	$keysCount = count($keywordsFile);
}else{
	$keysCount = $verbsCounted;
}

if(whichKeys() === "gifts"){
	$textFile = file($path.'bags.text.txt');
}else{
	$textFile = file($path.'pharm.text.txt');
}

for($i=0; $i<=$keysCount-1; $i++){

	$key3 = rndKeyword($_POST['keysFile']);
	$randCity = $citiesFile[rand(0, count($citiesFile) - 1)];

	if (isset($_POST['checkbox1'])){
		$state2 = " ".preg_replace('/(.*)\((.*)\)\n/', '$2', $randCity);
	}else{
		$state2 = null;
	}
	if (isset($_POST['checkbox4'])){
		$city2 = " ".preg_replace('/(.*)\((.*)\)\n/', '$1', $randCity);
	}else{
		$city2 = null;
	}


	$rndKey = rtrim($key3.$city2.$state2);

//...........................................................................Формируем рандомное предложение
$sentenceLen = rand(17,27);

for($q=0; $q<=rand(0,7); $q++){
	$words1 .= rndWords($textFile).rndSymbol();
}

while(true){
	$words2 .= rndWords($textFile).rndSymbol();

  if (str_word_count($words1.rndSymbol().$rndKey.rndSymbol().$words2) >= $sentenceLen){
    break;
  }
}

if(isset($_POST['checkbox11']))$keyBold = array("<b>", "</b>");

$randText .= ucfirst($words1).rndSymbol().$keyBold[0].$rndKey.$keyBold[1].rndSymbol().rtrim($words2, " ,").". ".nextLine($i);
$words1 = null;
$words2 = null;
}

//..........................................................Делаем замены для эстетики.
for($b = 1; $b <= 3; $b++){
$randText = preg_replace("/ in the\./", "here.", $randText);
$randText = preg_replace("/ the\./", ".", $randText); 
$randText = preg_replace("/ in a\./", "there.", $randText);
$randText = preg_replace("/ of\./", ".", $randText);
$randText = preg_replace("/ a\./", ".", $randText);
$randText = preg_replace("/ \w\./", ".", $randText);
$randText = preg_replace("/ your\./", " you.", $randText);
$randText = preg_replace("/ in\./", ".", $randText);
$randText = preg_replace("/(\w) because/", "$1, because", $randText);
$randText = preg_replace("/ i /", " I ", $randText);
$randText = preg_replace("/ and\./", ".", $randText);
$randText = preg_replace("/ of\./", ".", $randText);
$randText = preg_replace("/ to\./", ".", $randText);
$randText = preg_replace("/ as\./", ".", $randText);
$randText = preg_replace("/ of,/", " of", $randText);
$randText = preg_replace("/ to,/", " to", $randText);
$randText = preg_replace("/ as,/", " as", $randText);
$randText = preg_replace("/ in,/", " in", $randText);
$randText = preg_replace("/ a,/", " a", $randText);
$randText = preg_replace("/ the,/", " the", $randText);
$randText = preg_replace("/ during\./", ".", $randText);
$randText = preg_replace("/ the,/", ", the", $randText);
$randText = preg_replace("/\s\w{1}\./", ".", $randText);
$randText = preg_replace("/ \?,/", "?", $randText);
$randText = preg_replace("/ ,/", ",", $randText);
$randText = preg_replace("/\.,/", ".", $randText);
$randText = preg_replace("/\,\./", ".", $randText);
$randText = preg_replace("/, ,/", ", ", $randText);
$randText = preg_replace("/—,/", "—", $randText);
$randText = preg_replace("/,+/", ", ", $randText);
$randText = preg_replace("/\s+\./", ".", $randText);
$randText = preg_replace("/\"+/", "", $randText);
$randText = preg_replace("/\”+/", "", $randText);
$randText = preg_replace("/\-\./", ".", $randText);
}

//..........................................................Делаем замены для вставки в текст некоторых ссылок и ключей.
if(isset($_POST['checkbox9'])){
  $link = explode("|", $_POST["linksInText"]); 
  $anchors = $link[1];
  $randText = preg_replace("/".$anchors."/i", "<a href=\"".$link[0]."\">".$anchors."</a>", $randText, 1);
}

$randText = preg_replace("/\. (\w+ )/", ". $1<b>".$key.$city.$state2."</b> ", $randText, 1);
$randText = preg_replace("/cheap/", $key.$city.$state2, $randText, 1);

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
}

//Создание списка файлов с датой их последней модификации. Отображается при переходе по ссылке /?filesModified, доступно только если cookeis login=Demetri.
//Иначе отображает содержимое файла changes.txt
if(isset($_GET['filesModified']) && cookiesCheck() === "ok"){
	$allFiles = rglob($path, "/.*\..*/");
	$modifiedFiles = array();
	foreach ($allFiles as $filesnames2) {
		$modifiedFiles[] = array("file" => $filesnames2, "date" => filemtime($filesnames2));
	}
	usort($modifiedFiles, "cmp");
	$changesList = "<meta charset='utf-8' />\n<a href='javascript:window.history.back();'>Back</a><br><hr>\n";
	foreach($modifiedFiles as $mFile){
		$changesList .= $mFile['file']." | <font color=green>".date("d F Y H:i", filemtime($mFile['file']))."</font><br>";
	}
	echo $changesList;
	exit;
}elseif(isset($_GET['filesModified']) && cookiesCheck() === "no"){
	if(file_exists($path."changes.txt")){
		$changesFile = fopen("changes.txt", "r");
		$changesList = "<meta charset='utf-8' />\n<a href='javascript:window.history.back();'>Back</a><br><hr>\n";
		while(!feof($changesFile)){
    		$changesList .= fgets($changesFile)."<br>";
		}
	fclose($changesFile);
	echo $changesList;
	exit;
	}else{
		echo "<center>File changes.txt doesn't exist.</center>";
		exit;
	}
}
//////////////////////////////////////////////////////////

function rndSymbol(){
  //$symbolsArray =  array(" ", ", ", " ", ", ", " ", " ", " ", " ", " ");
  if (mt_rand(1, 5) == 1){
    $symbol = ", ";
  }else{
    $symbol = " ";
  }
	return $symbol;
}

// Функция разделения рандомного текста на абзацы. В одном абзаце минимум 2 предложения. 
function nextLine($linesCount){
  $symbolNewLine = array("<br><br>", "");
  //............................ Если счетчик цикла четное число, или это первый цикл, 
  //.............................то вставить HTML тэг абзаца с вероятностью 1/2.
  if ($linesCount%2 == 0 and $linesCount != 0)return $symbolNewLine[rand(0,1)];
}

function rndWords($textsFile){
	$words = $textsFile[rand(0, count($textsFile) - 1)];
	return rtrim($words);
}
function rndKeyword($keysFile){
	$f_contents = file($keysFile);
	$rndKeys = $f_contents[rand(0, count($f_contents) - 1)];
	return rtrim($rndKeys);
}
//Функция создания списка файлов рекурсивно.
function rglob($dir, $filter = '', &$results = array()) {
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value); 

        if(!is_dir($path)) {
            if(empty($filter) || preg_match($filter, $path)) $results[] = $path;
        } elseif($value != "." && $value != "..") {
            rglob($path, $filter, $results);
        }
    }
    return $results;
}
//Функция для сортировки многомерного массива с помощью usort.
function cmp($b, $a) {
        return $a["date"] - $b["date"];
}

//Проверка cookies.
function cookiesCheck(){
	global $approvedUsers, $cookies;

	if(in_array($cookies, $approvedUsers)){
		return "ok";
	}else{
		return "no";
	}
}

//Определение тематики кейвордов в зависимости от выбранной опции.
function whichKeys(){
  $keysTheme = null;
  if(isset($_POST["keysFile"]) && preg_match('/pharm\.keys\.txt/', $_POST["keysFile"])){
    $keysTheme = "pharm";
  }elseif(isset($_POST["keysFile"]) && preg_match('/bags\.keys\.txt/', $_POST["keysFile"])){
    $keysTheme = "gifts";
  }
  return $keysTheme;
}

?>
<title>Простой инструмент. Demetri Veni cybercrime@null.net</title>
<meta charset="UTF-8">
<center>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:center}
</style>
<table class="tg">
  <tr>
    <th class="tg-baqh">
    	<form method="post" action="">
   			<select name="keysFile">
  				<?php 
					$filePath = glob($path."*.keys.txt");

					foreach ($filePath as $filename) {
            			$file = preg_replace("/(.*)\/(.*)\.(.*)\.txt$/", "$2 $3", $filename);

            			if($_POST['keysFile']===$filename){
               				echo '<option selected value="'.$filename.'">'.$file.'</option>'.'\n';
              			}else{
                			echo '<option value="'.$filename.'">'.$file.'</option>'.'\n';
            			}
          			}
          		?>
			 </select>

  			</p>
  		<th>
  		<input type="checkbox" name="checkbox4" <?php if(isset($_POST['checkbox4']))echo 'checked';?>/>Добавлять город в "Random text".<Br>
        <input type="checkbox" name="checkbox1" <?php if(isset($_POST['checkbox1']))echo 'checked';?>/>Добавлять штат в "Random text".<Br>
        <?php 
          if(whichKeys() === "pharm"){
          	$checkbox3check = "unchecked";
          	$checkbox3Text = '<strike>Добавлять город в "Available models".</strike>';
          	$commentOn = "<!--";
          	$commentOff = "-->";
          	$enabled = "disabled";
            if(isset($_POST["checkbox9"]))$checked = "checked";
            if(isset($_POST['checkbox9'])){
              $linkAndAnchor = $_POST["linksInText"];
            }else{
              $linkAndAnchor = "http://buyviagra.online|Generic Viagra";
            }
            $linksInText = '<br><input type="text" name="linksInText" size=30 value="'.$linkAndAnchor.'"><input type="checkbox" name="checkbox9" '.$checked.'/> Вставлять ссылку?';
          }else{
          	if(isset($_POST['checkbox3'])){
          		$checkbox3check = 'checked';
          	}
          	$checkbox3Text = 'Добавлять город в "Available models".';
          	$commentOn = "";
          	$commentOff = "";
          	$enabled = "";
            $linksInText = "";
          }
        ?>
        <input type="checkbox" name="checkbox3" <?php echo $checkbox3check; echo " ".$enabled; ?>/><?php echo $checkbox3Text;?><Br>
        <input type="checkbox" name="checkbox2" <?php if(isset($_POST['checkbox2']))echo 'checked';?>/>Использовать низкочастотные ключи.<Br>
        </th>
        <th>
        <?php echo $commentOn ;?>
        Сколько ключей в "Available models"? (0 for all)<input type="text"" size="2" name="modelsCount" value="<?php echo $modelsCounted; ?>"/>
        <input type="checkbox" name="checkbox7" <?php if(isset($_POST['checkbox7']))echo 'checked';?>/>(запомнить/рандом).<br>
        <?php echo $commentOff ;?>
        Сколько предложений в "Random text"? (0 for all)<input type="text"" size="2" name="verbsCount" value="<?php echo $verbsCounted; ?>"/>
        <input type="checkbox" name="checkbox8" <?php if(isset($_POST['checkbox8']))echo 'checked';?>/>(запомнить/рандом).<br>
        <input type="checkbox" name="checkbox11" <?php if(isset($_POST['checkbox11']))echo 'checked';?>/>Выделять кеи в "Random Text".<br>
        <?php echo $linksInText; ?>
        </th>
  			<p><input type="submit"></p>
    </th>
  </tr>
  <tr>
    <td class="tg-baqh" colspan=3 id="key">
    <?php echo "<b>".$key." ".$city."</b>
    <br>".$state."<br><br>";
    if (whichKeys() === "gifts"){
      echo htmlspecialchars($anchorGifts[0].rtrim($key).$anchorGifts[1]);
    }elseif (whichKeys() === "pharm"){
      echo htmlspecialchars($anchorPharm[0].rtrim($key).$anchorPharm[1]);
    }
    ?>
    </td>
  </tr>
  <tr>
    <td class="tg-baqh" id="shipping" colspan=3> 
      <?php echo "Free shipping to: ".$shipping; ?></td>
  </tr>
  <?php echo $commentOn ;?>
  <tr>
    <td class="tg-baqh" id="places" colspan=3> 
      <?php echo "Available models: ".$models; ?></td>
  </tr>
  <?php echo $commentOff ;?>
  <tr>
  <td class="tg-baqh">Random text with keywords:
  </td>
    <td class="tg-baqh" id="randText" colspan=2><?php echo $randText; ?></td>
  </tr>
</table>
</form>
     <?php
     	//Определение даты последнего обновления файлов
					$allFiles = rglob($path, "/.*\..*/");

					foreach ($allFiles as $filesnames) {
						if($lastFileUpdate == null or filemtime($filesnames) > $lastFileUpdate){
							$lastFileUpdate = filemtime($filesnames);
						}
          			}
     	$updateDate	= date ("d F Y H:i", $lastFileUpdate);
     	$now = time();
     	$updDate = strtotime($updateDate);
     	$dateDiff = $now - $updDate;
     	if(floor($dateDiff/(60*60*24))!= 1) $c = "s";
     	$daysFromUpdate = floor($dateDiff/(60*60*24))." day".$c." ago";
     	if(floor($dateDiff/(60*60))!= 1) $s = "s";
     	if(floor($dateDiff/(60*60*24)) == 0)$daysFromUpdate = "<b>".floor($dateDiff/(60*60))." hour".$s." ago</b>";
     	if(floor($dateDiff/(60*60)) == 0)$daysFromUpdate = "<span id=\"timer\"></span>";
     ?>
<p style="font-size:10px"><?php echo "Version from \"".$updateDate."\" | (<a href=\"?filesModified\">last update</a>: ".$daysFromUpdate.")."; echo " Server time: ".date("d F Y H:i");?></p>
</center>

<script>
var seconds=0;
var minutes=["", ""];
var b = ["<b>", "", "</b>"];
var s = "";
var c = "";

var secondsFromUpd = <?php echo $dateDiff;?>;
if (secondsFromUpd > 60){
	minutes[0] = Math.floor(secondsFromUpd/60);
	minutes[1] = " minute";
	seconds = secondsFromUpd - minutes[0] * 60;
}else{
	seconds = secondsFromUpd;
}

if (minutes[0] >= 1){
	b[2] = "";
	b[1] = "</b>";
}

timer();

var counter=setInterval(timer, 1000);

function timer()
{
	seconds=seconds+1;

	if (seconds >= 60)
	{
		minutes[0] += 1;
		minutes[1] = " minute";
		seconds = 0;

		b[2] = "";
		b[1] = "</b>";
	}
	minutes[0] <= 1 ? s = " " : s = "s ";
	seconds == 1 ? c = " " : c = "s ";


 document.getElementById("timer").innerHTML = b[0] + minutes[0] + minutes[1] + s + b[1] + seconds + " second" + c + " ago" + b[2];
}
</script>