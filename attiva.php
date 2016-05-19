<!DOCTYPE html>
<html>
<head>
<title>attivazione profilo</title>
 
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
<body>
<div class="units-row">
<div class="unit-centered unit-80">

<h3 align="center">Conferma attivazione</h3>
<br><br>

<?php
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$username = trim($_GET['username']);
$chiave = trim($_GET['chiave']);
$strSQL = "SELECT * FROM utenti WHERE username='{$username}'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult) {
	echo "Mi spiace, ma non trovo i tuoi dati personali.";
}
else {
echo $objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br>';
mysql_query("UPDATE utenti SET active = '1' WHERE username='".$username."' AND chiave='".$chiave."'");
echo '<div class="tools-alert tools-alert-green">'."Il tuo profilo è stato attivato, ed ora puoi accedere a DAADO.".'<br><br>'."Prendi nota del tuo username (".'<font color="#1975FF"><b>'.$username.'</b></font>'.") e della tua password (".'<font color="#1975FF"><b>'.$objResult["password"].'</b></font>'.").".'<br>'."Ti serviranno per accedere al sito.".'</div>';
echo '<br><br><br>'."Clicca sulla freccia per effettuare il log in ed iniziare a registrare le attività che hai svolto.".'<br><br>'.'<a href="index.php"><img src="img/arrow_indietro.png" width="100" height="55" title="accedi" align="left"></a>';
}
mysql_close($objConnect);
?>

</div>
</div>
</body>
</html>