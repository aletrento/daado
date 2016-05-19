<!DOCTYPE html>
<html>
<head>
<title>conferma inserimento</title>
 
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

<br>

 <h3 align="center">Conferma salvataggio dati</h3>

<br><br>

<?php
mysql_connect("", "", "") or die(mysql_error());
mysql_select_db("my_daado") or die(mysql_error());

$calendario=$_SESSION["calendario"];
$cal=explode("-", $calendario);
$utente=$_SESSION["username"];
$anno=$cal[0];
$mese=$cal[1];
$giorno=$cal[2];
$ora_ini=mysql_real_escape_string($_SESSION["ora_ini"]);
$min_ini=mysql_real_escape_string($_SESSION["min_ini"]);
$ora_fine=mysql_real_escape_string($_SESSION["ora_fine"]);
$min_fine=mysql_real_escape_string($_SESSION["min_fine"]);
$durata=(((($ora_fine*60)+($min_fine))-(($ora_ini*60)+($min_ini)))/60);
$descrizione=mysql_real_escape_string($_SESSION["descrizione"]);
$categoria=$_SESSION["categoria"];
$tipo=$_SESSION["tipo"];
$tag=$_POST["tag"];
if (!$tag){
echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."Impossibile salvare i tuoi dati perché non hai scelto un tag per l'attività svolta.".'<br>'."Per favore torna indietro e completa.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
}
else{
mysql_query("INSERT INTO eventi (utente,giorno,mese,anno,ora_ini,min_ini,ora_fine,min_fine,descrizione,categoria,tipo,tag) VALUES ('$utente','$giorno','$mese','$anno','$ora_ini','$min_ini','$ora_fine','$min_fine','$descrizione','$categoria','$tipo','$_POST[tag]') ") or die(mysql_error());
echo '<div class="tools-alert tools-alert-green">'."I dati che hai inserito sono stati salvati correttamente.".'</div>';
$dup = mysql_query("SELECT giorno AND mese AND anno FROM eventi WHERE utente='{$_SESSION['username']}' AND giorno='".$giorno."' AND mese='".$mese."' AND anno='".$anno."' ");
if(mysql_num_rows($dup) >1){
echo '<div class="tools-alert tools-alert-yellow">'."Tuttavia, sono già state salvate delle attività per questo giorno. Controlla che non sia un ".'<u>'."duplicato".'</u>'.".".'</div><br>';
}
else{
echo '<div class="tools-alert tools-alert-green">'."Questa è la prima attività registrata per questo giorno.".'</div><br>';
}
}
?>

<div align="left">
<a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro" align="center"></a> Se vuoi inserirne altri, torna indietro.
</div>

<br><br>

<div align="left">
Se hai terminato, controlla la <a href="tabella.php">tabella</a> con tutti i dati che hai salvato finora e verifica la situazione attuale (<a href="maths.php">totale ore</a>).
</div>
<?php
mysql_close();
?>
</div>
</div>

</body>
</html>