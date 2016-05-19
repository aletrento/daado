<!DOCTYPE html>
<html>
<head>
<title>inserimento dati</title>
 
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="keywords" content="docenti, scuola secondaria, Trentino, ore, database, articoli, recupero">
<meta name="description" content="sito per la registrazione delle attività aggiuntive svolte a scuola">
<meta name="author" content="Alessandro Vallin">

<link rel="stylesheet" href="css/kube.min.css" />
<link rel="stylesheet" href="css/stile.css" />
<link rel="stylesheet" href="css/animate.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="icon" href="img/clip.ico" />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
<script src="js/kube.min.js"></script>
<script src="sorttable.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(function() {
var availableTags = [
"assemblea",
"Collegio docenti",
"colloquio con",
"conferenza",
"Consiglio di classe",
"corso",
"corso di aggiornamento",
"corso di alfabetizzazione",
"corso di recupero carenze",
"corso di sostegno",
"esami di idoneità",
"incontro con",
"incontro con coordinatori",
"incontro di orientamento",
"laboratorio di",
"lezione",
"lezione CLIL",
"lezione in laboratorio con",
"lezione itinerante con",
"organizzazione di",
"progetto",
"progetto multidisciplinare",
"programmazione",
"riunione",
"riunione di commissione",
"riunione di dipartimento",
"riunione di gruppo di lavoro",
"riunione di progetto",
"riunione di programmazione con colleghi",
"simulazione di",
"sorveglianza",
"sostituzione di collega assente",
"sportello didattico",
"udienze generali",
"udienze individuali",
"uscita con",
"visita presso"
];
$( "#desc" ).autocomplete({
source: availableTags
});
});
</script>
  <script src="jquery/external/jquery/jquery.js"></script>
  <script src="jquery/jquery-ui.js"></script>
  <script src="jquery/jquery.ui.datepicker-it.js"></script>
<script>
$(function(){
        $('#datepicker').datepicker({
            inline: true,
            showOtherMonths: true,
	    	dateFormat: "yy-mm-dd",
        });
        $.datepicker.setDefaults($.datepicker.regional['it']);
    });
</script>
<style type="text/css">
div {
  -webkit-animation-delay: 3s;
  -moz-animation-delay: 3s;
  -ms-animation-delay: 3s;
}
</style>
</head>
<?
session_start();
session_regenerate_id(TRUE);
if (!isset($_SESSION['username'] ) )
{
header('location:index.php');
exit;
}
else
{
echo "utente collegato: ".$_SESSION['username'].'<br>'.'<a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a>';
}
?>
<body>
<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = "SELECT * FROM utenti WHERE username='{$_SESSION['username']}'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Mi spiace, ma non trovo i tuoi dati personali.";
}
elseif ($objResult["scuola"] == "I. T. 'F. e G. Fontana' - Rovereto")
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br><div class="tools-alert" align="left">'."Guida per i docenti dell'ITCG 'Fontana':&nbsp;&nbsp;&nbsp;".'<a href="fontana.php"><img src="img/compass.png" width="60" height="60" alt="bussola" title="guida" align="middle"></a></div>';
}
elseif ($objResult["scuola"] == "Liceo 'A. Rosmini' - Trento")
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br><div class="tools-alert" align="left">'."Guida per i docenti del Liceo 'Rosmini':&nbsp;&nbsp;&nbsp;".'<a href="rosminitn.php"><img src="img/compass.png" width="60" height="60" alt="bussola" title="guida" align="middle"></a></div>';
}
elseif ($objResult["scuola"] == "Liceo 'L. da Vinci' - Trento")
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br><div class="tools-alert" align="left">'."Guida per i docenti del Liceo 'Da Vinci':&nbsp;&nbsp;&nbsp;".'<a href="davinci.php"><img src="img/compass.png" width="60" height="60" alt="bussola" title="guida" align="middle"></a></div>';
}
elseif ($objResult["scuola"] == "I. I. 'M. Curie' - Pergine")
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br><div class="tools-alert" align="left">'."Guida per i docenti dell'Istituto 'Curie':&nbsp;&nbsp;&nbsp;".'<a href="curie.php"><img src="img/compass.png" width="60" height="60" alt="bussola" title="guida" align="middle"></a></div>';
}
else
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"];
}
mysql_close($objConnect);
?>

<div class="tools-alert tools-alert-green animated bounce" align="left">
<h4>Se devi registrare attività riconosciute in modo forfetario, vai a <a href="forfait.php"><font color="#297ACC">questa pagina</font></a>.</h4>
</div>

<div class="units-row">
<div class="unit-centered unit-80">

<br>

 <h3 align="center">Registra un'attività che hai svolto</h3>

<br>

<div class="tools-alert tools-alert-yellow" align="left">
<font color="#4D94FF"><b>Ricorda che i Consigli di Classe di gennaio e giugno (scrutini) e le udienze individuali sono atti dovuti, e NON devono essere registrati.</b></font>
</div>

<br>

<div class="ui-widget" align="left">
<form action="conferma.php" method="POST" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" class="forms">
&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona dal calendario la <font color="#6D8D4D"><b>data</b></font> (<i>AAAA-MM-GG</i>) in cui hai svolto l'attività:
<input type="text" id="datepicker" name="calendario" placeholder="ad es. 2015-09-30">
<div class="forms-desc">
(se con Explorer non vedi il calendario, premi F12 e seleziona "modalità documento: standard di Internet Explorer")
</div>
<br><br>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Scrivi l'<font color="#6D8D4D"><b>orario</b></font> dell'attività che hai svolto <small>(in formato 24 ore)</small>:
<br>
<div class="units-row">
 <div class="unit-10"></div>
 <div class="unit-90">
 <div class="table-container" align="center">
   <table class="table-simple">
    <tbody>
     <tr>
      <td>inizio attività</td>
      <td>ora: <input type="text" name="ora_ini" maxlength="2" placeholder="ad es. 14" /></td>
      <td>minuti: <input type="text" name="min_ini" maxlength="2" placeholder="ad es. 20" /></td>
     </tr>
     <tr>
      <td>fine attività</td>
      <td>ora: <input type="text" name="ora_fine" maxlength="2" placeholder="ad es. 16" /></td>
      <td>minuti: <input type="text" name="min_fine" maxlength="2" placeholder="ad es. 35" /></td>
     </tr>
    </tbody>
   </table>
 </div>
 </div>
</div>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;<font color="#6D8D4D"><b>Descrivi</b></font> brevemente l'attività svolta:
<input id="desc" type="text" name="descrizione" class="width-40" maxlength="60" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;" placeholder="cosa hai fatto?" />

<br><br>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona una <font color="#6D8D4D"><b>categoria</b></font>:
<select name="categoria" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;">
	<option value="" disabled selected style='display:none;' style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> su quale articolo?
	<option value="80" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> 80 (att. funzionali)
	<option value="40" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> 40 (art. 3 - potenziamento)
	<option value="70" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> 70 (art. 2)
	<option value="fondo" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> FUIS
	<option value="dubbie" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> non so ancora
</select>

<br><br>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Scegli il <font color="#6D8D4D"><b>tipo</b></font> di attività:
<select name="tipo" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;">
	<option value="" disabled selected style='display:none;' style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> assieme agli studenti?
	<option value="f" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> frontale
	<option value="nf" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> non frontale
</select>

<br><br>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona un'etichetta (<font color="#6D8D4D"><b>tag</b></font>).
<ul>
 <li>Per le <em>sostituzioni</em>, i <em>corsi di recupero</em>, gli <em>sportelli</em>, i <em>corsi extracurricolari</em> e le <em>lezioni itineranti</em> (tag 4, 7, 8, 9 e 10) la durata delle attività è espressa in <font color="#7A5229"><b>unità orarie di 50'</b></font>.</li>
 <li>La durata di tutte le altre attività è indicata in <font color="#7A5229"><b>unità orarie di 60'</b></font>.</li>
</ul>

<div class="table-container" align="center">
<table class="table-hovered">
 <tr>
  <th class="text-centered highlight"></th>
  <th class="text-centered highlight">tag</th>
  <th class="text-centered highlight"></th>
  <th class="text-centered highlight">tag</th>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="1" checked></td>
   <td>Collegio docenti</td>
   <td><input type="radio" name="tag" value="2"></td>
   <td>Consiglio di classe</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="3"></td>
   <td>riunione di dipartimento</td>
   <td><input type="radio" name="tag" value="4"></td>
   <td>sostituzione di collega assente</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="5"></td>
   <td>udienze</td>
   <td><input type="radio" name="tag" value="6"></td>
   <td>corso di aggiornamento</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="7"></td>
   <td>corso di recupero carenze (ed esami idoneità)</td>
   <td><input type="radio" name="tag" value="8"></td>
   <td>sportello didattico</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="9"></td>
   <td>corso extracurricolare (sostegno, CLIL, ecc.)</td>
   <td><input type="radio" name="tag" value="10"></td>
   <td>lezione itinerante (in orario di servizio)</td>
 </tr>
  <tr>
   <td><input type="radio" name="tag" value="11"></td>
   <td>programmazione con colleghi</td>
   <td><input type="radio" name="tag" value="12"></td>
   <td>riunione di progetto/commissione/gruppo di lavoro</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="13"></td>
   <td>sorveglianza</td>
   <td><input type="radio" name="tag" value="14"></td>
   <td>altro</td>
 </tr>
</table>
</div>

<br>

<div align="center">
<input type="submit" name="invia" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" value="salva" class="btn btn-round" />
</div>
</form>
</div>

<div align="right">
Visualizza la <a href="tabella.php">tabella</a> con tutti i dati che hai salvato finora.
</div>

<br>

<div align="right">
Verifica la situazione attuale (<a href="maths.php">totale ore</a>).
</div>

</div>
</div>

</body>
</html>