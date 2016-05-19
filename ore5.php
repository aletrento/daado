<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>inserimento 5/6</title>
 
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
<?php
if((isset($_POST['categoria']) && trim($_POST['categoria'])!="") && $_GET['pg']==4){
 $_SESSION['categoria']=$_POST['categoria'];
 $errore1="";
}
else{
 if($_GET['pg']==6){
 $errore1="";
}
else{
 $errore1='<br><br><br><br><div class="tools-alert tools-alert-red">'."Errore.".'<br>'."E' impossibile procedere perché non hai selezionato una categoria.".'</div>';
}
}
if($errore1!=""){
 echo "$errore1";
?>
<center>
<a href="ore4.php?pg=5"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a>
</center>
<?php
}
else{
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = "SELECT * FROM utenti WHERE username='{$_SESSION['username']}'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult){
	echo "Mi spiace, ma non trovo i tuoi dati personali.";
}
else{
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"];
}
mysql_close($objConnect);
?>
<div class="units-row">
<div class="unit-centered unit-80">
<br>
 <h3 align="center">Registra un'attività che hai svolto - tipo</h3>

<br><br>

<form action="ore6.php?pg=5" method="POST" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" class="forms">
<div class="table-container" align="center">
<table>
 <tr>
  <td>
&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Scegli il <font color="#6D8D4D"><b>tipo</b></font> di attività:
  </td>
  <td>
<select name="tipo" class="width-40" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;">
	<option value="" disabled selected style='display:none;' style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> assieme agli studenti?
	<option value="f" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> frontale
	<option value="nf" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;"> non frontale
</select>
  </td>
  </tr>
</table>
</div>
<div align="center">
<input type="submit" name="invia" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" value="prosegui >>" class="btn btn-round width-30" />
</div>
</form>

<div align="left">
<?php
$aaa = 33.3;
echo '<label>avanzamento:  </label><span class="bar" style="background-position: -'.$aaa.'px 0;">5 di 6</span>';
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