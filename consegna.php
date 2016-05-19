<!DOCTYPE html>
<html>
<head>
<title>conferma invio</title>
 
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
echo "utente collegato: ".$_SESSION['username'].'<br><br>'.'<a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a><br><br><br><br>';
}
?>
<body>

<div class="units-row">
<div class="unit-centered unit-80">

<br>

 <h3 align="center">Conferma invio risposte</h3>

<br><br>

<?php
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database.");
mysql_select_db("my_daado") or die(mysql_error());
$utente=$_SESSION['username'];
$q1=mysql_real_escape_string($_POST["q1"]);
$q2=mysql_real_escape_string($_POST["q2"]);
$q3=mysql_real_escape_string($_POST["q3"]);
$q4=mysql_real_escape_string($_POST["q4"]);
$q5=mysql_real_escape_string($_POST["q5"]);
$q6=mysql_real_escape_string($_POST["q6"]);
$q7=mysql_real_escape_string($_POST["q7"]);
$q8=mysql_real_escape_string($_POST["q8"]);
$q9=mysql_real_escape_string($_POST["q9"]);
if (!$q1 or !$q2 or !$q3 or !$q4 or !$q5 or !$q6 or !$q7 or !$q8 or !$q9)
{
echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."impossibile inviare il tuo questionario compilato perché hai tralasciato qualche risposta.".'<br>'."Per favore torna indietro e completa.".'</div>';
}
else
{
$sql = mysql_query("SELECT * FROM questionario WHERE utente = '$utente'");
$num_rows = mysql_num_rows($sql);
if ( $num_rows == 0 )
{
mysql_query("INSERT INTO questionario (utente,q1,q2,q3,q4,q5,q6,q7,q8,q9) VALUES ('$utente','$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9') ") or die(mysql_error());
echo '<div class="tools-alert tools-alert-green">'."Le tue risposte sono state inviate correttamente. Grazie.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'</div><img src="img/que.png" width="95" height="120" title="questionario" align="middle">';
}
else
{
echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."un questionario con il tuo username (".'<b>'.$utente.'</b>'.") è già stato inviato.".'<br>'."Mi spiace ma una volta è sufficiente.".'</div>';
}
}
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>