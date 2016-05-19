<!DOCTYPE html>
<html>
<head>
<title>statistiche</title>
 
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="keywords" content="docenti, scuola secondaria, Trentino, ore, database, articoli, recupero">
<meta name="description" content="sito per la registrazione delle attività aggiuntive svolte a scuola">
<meta name="author" content="Alessandro Vallin">

<link rel="stylesheet" href="css/kube.min.css" />
<link rel="stylesheet" href="css/stile.css" />
<link rel="icon" href="img/clip.ico" />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
<script src="js/kube.min.js"></script>
<script src="sorttable.js"></script>

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
echo "utente collegato: ".$_SESSION['username'].'<br><br>'.'<a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a>';
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
?>
<?php echo $objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"];?>
<br>
<?php echo "scuola: ".$objResult["scuola"];?>
<br>
<?php echo "disciplina: ".$objResult["materia"];?>
<br>
<?php echo "a.s.: ".$objResult["anno"];?>
<?
}
?>
(oggi è il giorno: <?php echo (date("d-m-y"));?>)

<div class="units-row">
<div class="unit-centered unit-80">

<br><br>

<div align="left">
<a href="statistiche.php"><img src="img/arrow_indietro.png" width="70" height="35" title="indietro"></a>
</div>

<br><br>

<h3 align="center">Statistiche (6/7)</h3>

<br><br>

<div class="tools-alert" align="left">
Nel complesso, quali attività aggiuntive hai svolto più frequentemente?
<br><br>
Questo grafico mostra la percentuale (rispetto al totale) delle attività relative a ciascun <i>tag</i>. Quelle di tipo forfetario non sono prese in considerazione.<br>
<small>Per salvare l'immagine: click tasto destro --> "salva immagine con nome".</small>
</div>

<br><br>

<div align="center">
<figure>
<img src="grafico_06.php" />
</figure>
</div>

<div class="table-container" align="center">
<table class="table-stripped">
 <tr>
  <th class="text-centered highlight">nr. tag</th>
  <th class="text-centered highlight">significato</th>
  <th class="text-centered highlight">nr. tag</th>
  <th class="text-centered highlight">significato</th>
 </tr>
 <tr>
  <td class="text-centered">1</td>
  <td class="text-left">Collegio docenti</td>
  <td class="text-centered">2</td>
  <td class="text-left">Consiglio di classe</td>
 </tr>
 <tr>
  <td class="text-centered">3</td>
  <td class="text-left">riunione di dipartimento</td>
  <td class="text-centered">4</td>
  <td class="text-left">sostituzione collega assente</td>
 </tr>
 <tr>
  <td class="text-centered">5</td>
  <td class="text-left">udienze</td>
  <td class="text-centered">6</td>
  <td class="text-left">corso di aggiornamento</td>
 </tr>
 <tr>
  <td class="text-centered">7</td>
  <td class="text-left">corso di recupero carenze (ed esami idoneità)</td>
  <td class="text-centered">8</td>
  <td class="text-left">sportello disciplinare</td>
 </tr>
 <tr>
  <td class="text-centered">9</td>
  <td class="text-left">corso extracurricolare (sostegno, CLIL, ecc.)</td>
  <td class="text-centered">10</td>
  <td class="text-left">lezione itinerante</td>
 </tr>
 <tr>
  <td class="text-centered">11</td>
  <td class="text-left">programmazione con colleghi</td>
  <td class="text-centered">12</td>
  <td class="text-left">riunione di progetto/commissione</td>
 </tr>
 <tr>
  <td class="text-centered">13</td>
  <td class="text-left">sorveglianza</td>
  <td class="text-centered">14</td>
  <td class="text-left">altro</td>
 </tr>
</table>
</div>

</div>
</div>

</body>
</html>
