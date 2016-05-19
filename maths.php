<!DOCTYPE html>
<html>
<head>
<title>calcolo</title>
 
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
echo $objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br>';
}
mysql_close($objConnect);
?>
 (oggi è il giorno: <?php echo (date("d-m-y"));?>)

<br><br><br>

<div class="units-row">
<div class="unit-centered unit-80">

 <h3 align="center">Consuntivo delle attività svolte</h3>

<br><br>
 
<div class="tools-alert tools-alert-yellow" align="left">
Per calcolare il totale delle ore da effettuare e delle ore svolte finora, per favore <font color="#2E8AE6">inserisci il tuo monte ore settimanale</font> (le ore di cattedra retribuite):
</div>
<div class="tools-alert" align="left">
  <form class="forms" action="somme.php" method="POST">
   monte ore settimanale:
   <input name="monte" class="width-15" type="text" maxlength="2" />
   <input type="submit" class="btn btn-round btn-blue btn-outline" name="calcola" value="calcola" />
  </form>
</div>

<div align="right">
Torna alla pagina di <a href="ore1.php">inserimento</a> dati.
</div>
<br>
<div align="right">
Torna alla tabella di <a href="tabella.php">riepilogo</a>.
</div>

</div>
</div>

</body>
</html>