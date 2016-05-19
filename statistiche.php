<!DOCTYPE html>
<html>
<head>
<title>DAADO - statistiche</title>
 
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
mysql_close($objConnect);
?>
(oggi è il giorno: <?php echo (date("d-m-y"));?>)

<div class="units-row">
<div class="unit-centered unit-80">

<br><br>

 <h3 align="center">Qualche dato in più</h3>
 
<br><br>

<div align="right">
Torna alla pagina di <a href="ore1.php">inserimento</a> dati.
<br><br>
Torna alla tabella di <a href="tabella.php">riepilogo</a>.
<br><br>
Torna alla tabella di <a href="maths.php">consuntivo</a>.
</div>

<br><br>

<div class="table-container" align="center">
<table class="table-hovered">
 <tr>
  <th class="text-centered highlight">STATISTICHE</th>
  <th class="text-centered highlight"></th>
 </tr>
 <tr>
  <td class="text-left">Qual è il mese nel quale hai lavorato di più?</td>
  <td class="text-centered"><a href="stats_01.php"><img src="img/stats.png" width="25" height="25" title="grafico 1"></a></td>
 </tr>
 <tr>
  <td class="text-left">In quale mese hai svolto più attività frontali?</td>
  <td class="text-centered"><a href="stats_02.php"><img src="img/stats.png" width="25" height="25" title="grafico 2"></a></td>
 </tr>
 <tr>
  <td class="text-left">Come sono distribuite le ore frontali che hai svolto?</td>
  <td class="text-centered"><a href="stats_03.php"><img src="img/stats.png" width="25" height="25" title="grafico 3"></a></td>
 </tr>
 <tr>
  <td class="text-left">In quale fascia oraria hai lavorato di più?</td>
  <td class="text-centered"><a href="stats_04.php"><img src="img/stats.png" width="25" height="25" title="grafico 4"></a></td>
 </tr>
 <tr>
  <td class="text-left">Se hai caricato attività sul FUIS, come sono distribuite?</td>
  <td class="text-centered"><a href="stats_05.php"><img src="img/stats.png" width="25" height="25" title="grafico 5"></a></td>
 </tr>
 <tr>
  <td class="text-left">Nel complesso, quali attività aggiuntive hai svolto più frequentemente?</td>
  <td class="text-centered"><a href="stats_06.php"><img src="img/stats.png" width="25" height="25" title="grafico 6"></a></td>
 </tr>
 <tr>
  <td class="text-left">Qual è stato il carico orario mensile relativo a ciascun articolo?</td>
  <td class="text-centered"><a href="stats_07.php"><img src="img/stats.png" width="25" height="25" title="grafico 7"></a></td>
 </tr>
</table>
</div>

</div>
</div>

</body>
</html>
