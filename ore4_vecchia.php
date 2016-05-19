<?php
//let's start the session
session_start();
 
//now, let's register our session variables
session_register('descrizione');

//finally, let's store our posted values in the session variables
$_SESSION['descrizione'] = $_POST['descrizione'];
?>
<!DOCTYPE html>
<html>
<head>
<title>inserimento 4/6</title>
 
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
<style type="text/css">
div {
  -webkit-animation-delay: 3s;
  -moz-animation-delay: 3s;
  -ms-animation-delay: 3s;
}
span.bar {
    background: url(img/bar.png) 0 0 repeat-y;
    display: block;
    width: 200px;
    line-height: 20px;
}
</style>
</head>
<?
//session_start();
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
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br><div class="tools-alert tools-alert-yellow" align="left">'."Se non sai su quale articolo caricare questa attività, consulta la guida per i docenti dell'ITCG 'Fontana':&nbsp;&nbsp;&nbsp;".'<a href="fontana.php" target="_blank"><img src="img/compass.png" width="60" height="60" alt="bussola" title="guida" style="vertical-align:middle"></a></div>';
}
elseif ($objResult["scuola"] == "Liceo 'A. Rosmini' - Trento")
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br><div class="tools-alert tools-alert-yellow" align="left">'."Se non sai su quale articolo caricare questa attività, consulta la guida per i docenti del Liceo 'Rosmini':&nbsp;&nbsp;&nbsp;".'<a href="rosminitn.php" target="_blank"><img src="img/compass.png" width="60" height="60" alt="bussola" title="guida" style="vertical-align:middle"></a></div>';
}
elseif ($objResult["scuola"] == "Liceo 'L. da Vinci' - Trento")
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br><div class="tools-alert tools-alert-yellow" align="left">'."Se non sai su quale articolo caricare questa attività, consulta la guida per i docenti del Liceo 'Da Vinci':&nbsp;&nbsp;&nbsp;".'<a href="davinci.php" target="_blank"><img src="img/compass.png" width="60" height="60" alt="bussola" title="guida" style="vertical-align:middle"></a></div>';
}
elseif ($objResult["scuola"] == "I. I. 'M. Curie' - Pergine")
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br><div class="tools-alert tools-alert-yellow" align="left">'."Se non sai su quale articolo caricare questa attività, consulta la guida per i docenti dell'Istituto 'Curie':&nbsp;&nbsp;&nbsp;".'<a href="curie.php" target="_blank"><img src="img/compass.png" width="60" height="60" alt="bussola" title="guida" style="vertical-align:middle"></a></div>';
}
else
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"];
}
mysql_close($objConnect);
?>
<div class="units-row">
<div class="unit-centered unit-80">
<?php
if (!$_SESSION['descrizione'])
{
echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."E' impossibile procedere perché non hai descritto l'attività svolta.".'<br><br>'."Per favore torna indietro e completa.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
}
else
  {
?>
 <h3 align="center">Registra un'attività che hai svolto - categoria</h3>
<br><br>

<div class="ui-widget" align="left">
<form action="ore5.php" method="POST" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" class="forms">

<div class="table-container" align="center">
<table>
 <tr>
  <td>
&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona una <font color="#6D8D4D"><b>categoria</b></font>:
  </td>
  <td>
<select name="categoria" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;">
	<option value="" disabled selected style='display:none;' style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;">su quale articolo?
	<option value="80" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> 80 (att. funzionali)
	<option value="40" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> 40 (art. 3 - potenziamento)
	<option value="70" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> 70 (art. 2)
	<option value="fondo" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> FUIS
	<option value="dubbie" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> non so ancora
</select>
</td>
 </tr>
</table>
</div>
<div align="center">
<input type="submit" name="invia" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" value="prosegui >>" class="btn btn-round width-30" />
</div>
</form>
</div>

<div align="left">
<?
$aaa = 66.7;
echo '<label>avanzamento:  </label><span class="bar" style="background-position: -'.$aaa.'px 0;">4 di 6</span>';
?>
</div>

<br><br>

<div align="right">
Visualizza la <a href="tabella.php">tabella</a> con tutti i dati che hai salvato finora.
</div>

<br>

<div align="right">
Verifica la situazione attuale (<a href="maths.php">totale ore</a>).
</div>

</div>
</div>
<?php
}
?>
</body>
</html>
