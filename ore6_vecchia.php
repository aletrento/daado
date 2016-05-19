<?php
//let's start the session
session_start();
 
//now, let's register our session variables
session_register('tipo');

//finally, let's store our posted values in the session variables
$_SESSION['tipo'] = $_POST['tipo'];
?>
<!DOCTYPE html>
<html>
<head>
<title>inserimento 6/6</title>
 
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
else
{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"];
}
mysql_close($objConnect);
?>
<div class="units-row">
<div class="unit-centered unit-80">
<?php
if (!$_SESSION['tipo'])
{
echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."E' impossibile procedere perché non hai specificato se l'attività è frontale o non frontale.".'<br><br>'."Per favore torna indietro e completa.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
}
else
  {
?>
<br>
 <h3 align="center">Registra un'attività che hai svolto - etichetta</h3>
<br><br>

<div class="ui-widget" align="left">
<form action="conferma.php" method="POST" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" class="forms">

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
<div align="center">
<input type="submit" name="invia" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" value="SALVA" class="btn btn-green btn-outline width-40" />
</div>
</form>
</div>

<div align="left">
<?
$aaa = 0;
echo '<label>avanzamento:  </label><span class="bar" style="background-position: -'.$aaa.'px 0;">6 di 6</span>';
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