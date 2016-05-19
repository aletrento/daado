<!DOCTYPE html>
<html>
<head>
<title>frequenze</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="keywords" content="docenti, scuola secondaria, Trentino, ore, database, articoli, recupero" />
<meta name="description" content="sito per la registrazione delle attività aggiuntive svolte a scuola" />
<meta name="author" content="Alessandro Vallin" />
<link rel="stylesheet" href="css/kube.min.css" />
<link rel="stylesheet" href="css/stile.css" />
<link rel="icon" href="img/clip.ico" />
<link rel="stylesheet" type="text/css" href="css/jqcloud.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
<script src="js/kube.min.js"></script>
<script src="sorttable.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="css/jqcloud-1.0.4.js"></script>
<script type="text/javascript">
var word_array = [
      {text: "corso", weight: 20},
      {text: "classe", weight: 19},
      {text: "consiglio", weight: 16},
      {text: "riunione", weight: 10},
      {text: "carenze", weight: 9},
      {text: "sostituzione", weight: 9},
      {text: "recupero", weight: 9},
      {text: "docenti", weight: 8},
      {text: "classi", weight: 8},
      {text: "collega", weight: 7},
      {text: "assente", weight: 7},
      {text: "dipartimento", weight: 7},
      {text: "collegio", weight: 6},
      {text: "incontro", weight: 5},
      {text: "aggiornamento", weight: 5},
      {text: "tutoraggio", weight: 3}
      ];
$(function() {
$("#cloud").jQCloud(word_array);
});
</script>
<style type="text/css">
div.jqcloud {
  font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;
  font-size: 10pt;
  line-height: normal;
}
div.jqcloud span.w10 { font-size: 400%; }
div.jqcloud span.w9 { font-size: 350%; }
div.jqcloud span.w8 { font-size: 310%; }
div.jqcloud span.w7 { font-size: 270%; }
div.jqcloud span.w6 { font-size: 220%; }
div.jqcloud span.w5 { font-size: 190%; }
div.jqcloud span.w4 { font-size: 160%; }
div.jqcloud span.w3 { font-size: 130%; }
div.jqcloud span.w2 { font-size: 100%; }
div.jqcloud span.w1 { font-size: 90%; }
div.jqcloud { color: #09f; }
div.jqcloud a { color: inherit; }
div.jqcloud a:hover { color: #0df; }
div.jqcloud a:hover { color: #0cf; }
div.jqcloud span.w10 { color: #FFD8AA; }
div.jqcloud span.w9 { color: #7E82B0; }
div.jqcloud span.w8 { color: #D5B86B; }
div.jqcloud span.w7 { color: #D5A46B; }
div.jqcloud span.w6 { color: #28546C; }
div.jqcloud span.w5 { color: #323875; }
div.jqcloud span.w4 { color: #AA8B39; }
div.jqcloud span.w3 { color: #AA7639; }
div.jqcloud span.w2 { color: #553E00; }
div.jqcloud span.w1 { color: #6F90A2; }
div.jqcloud {
  overflow: hidden;
  position: relative;
}
div.jqcloud span { padding: 0; }
</style>
</head>
<body>

<nav class="navbar navbar-pills">
 <ul>
  <li><a href="intro.php"><img src="img/what.png" width="35" height="35" alt="intro"></a></li>
  <li><a href="index.php"><img src="img/signin.png" width="35" height="35" alt="accedi"></a></li>
  <li><a href="registrazione.php"><img src="img/signup.png" width="35" height="35" alt="iscriviti"></a></li>
  <li><a href="info.php"><img src="img/pie.png" width="35" height="35" alt="numeri"></a></li>
  <li><a href="files.php"><img src="img/share.png" width="35" height="35" alt="condividi"></a></li>
 </ul>
</nav>

<div class="units-row">
<div class="unit-centered unit-80">

<br>

 <h1 align="center"><font color="#B8A08A">D</font>.<font color="#FFB870">A</font>.<font color="#9ABA88">A</font>.<font color="#ADC2FF">DO</font>.</h1>
 <h2 align="center"><font color="#B8A08A">D</font>atabase delle <font color="#FFB870">A</font>ttività <font color="#9ABA88">A</font>ggiuntive dei <font color="#ADC2FF">DO</font>centi</h2>
 <br>
 <h3 align="center">facciamo i conti con le parole</h3>

<br><br>

<center>
<div id="cloud" style="width: 400px; height: 260px;"></div>
</center>

<br><br>

<div>
Le attività svolte vengono descritte brevemente dagli utenti che le registrano su DAADO.<br>
Ecco l'elenco dei <font color="#7A5C99">termini più frequenti</font>, che appaiono tre o più volte nel database (puoi ordinare i dati in modo diverso cliccando sulle celle dell'intestazione):
</div>

<br>

<center>
<div class="table-container">
<table class="table-hovered sortable">
 <tr>
  <th class="text-left highlight">termine</th>
  <th class="text-centered highlight"># occorrenze</th>
 </tr>
<?
$filename = "docs/eventi.sql";
$content = strtolower(file_get_contents($filename));
$wordArray = preg_split('/[^a-z]/', $content, -1, PREG_SPLIT_NO_EMPTY);
$filteredArray = array_filter($wordArray, function($x){
return !preg_match("/^(.|a|ad|afm|agl|agli|ai|al|all|alla|alle|allo|anche|auto|babinatti|capraro|character|che|chi|ci|clara|client|coi|col|collate|collation|come|con|connection|contro|cui|da|dagl|dagli|dai|dal|dall|dalla|dalle|dallo|degl|degli|dei|del|dell|della|delle|dello|di|dov|dove|dubbie|e|ed|eventi|f|farruggiafra|fine|fra|gli|i|id|iii|il|in|ini|int|io|l|la|le|lei|li|lisaborsato|lo|loro|lui|ma|marta|mi|mia|mie|miei|min|mio|ne|negl|negli|nei|nel|nell|nella|nelle|nello|nf|noi|non|nostra|nostre|nostri|nostro|not|null|old|ora|paolocarli|per|perché|più|results|se|set|sia|spagnolo|su|sua|sue|sugl|sugli|sui|sul|sull|sulla|sulle|sullo|suo|suoi|ti|tra|tu|tua|tue|tuo|tuoi|un|una|unicode|uno|utf|vallin|varchar|vi|voi|vostra|vostre|vostri|vostro)$/",$x);
});
$wordFrequencyArray = array_count_values($filteredArray);
$my_value = 3;
$filtered_array = array_filter($wordFrequencyArray, function ($element) use ($my_value) { return ($element >= $my_value); } );
arsort($filtered_array);
foreach($filtered_array as $k => $v)
echo '<tr><td class="text-left">'.$k.'</td><td class="text-centered">'.$v.'</td></tr>';
?>
</table>
</div>
</center>

</div>
</div>

</body>
</html>
