<!DOCTYPE html>
<html>
<head>
<title>conferma eliminazione</title>
 
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

<div class="units-row">
<div class="unit-centered unit-80">

 <div>
  <h2><p align="center">Conferma eliminazione</p></h2><img src="img/bin.png" width="19" height="20" title="cancella" align="middle">
 </div>

<br><br>

<p align="right">
Torna alla tabella di <a href="tabella.php">riepilogo</a> dati.
</p>

<?php
$host="";
$username="";
$password="";
$db_name="my_daado";
$tbl_name="eventi";

mysql_connect("$host", "$username", "$password") or die ("cannot connect");
mysql_select_db("$db_name") or die ("cannot select DB");

$id=$_GET['id'];

$sel="SELECT * FROM $tbl_name WHERE id='$id'";
$ris=mysql_query($sel);
$str=mysql_fetch_array($ris);
$sql="DELETE FROM $tbl_name WHERE id='$id'";
$result=mysql_query($sql);
if($result)
{
echo '<div class="tools-alert tools-alert-green">'."L'attività è stata eliminata.".'</div>';
}
else {
	echo '<div class="tools-alert tools-alert-red">'."Errore: impossibile eliminare i dati selezionati".'</div>';
}
mysql_close();
?>

</div>
</div>
 
</body>
</html>