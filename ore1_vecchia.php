<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>inserimento 1/6</title>
 
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
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="jquery/jquery.ui.datepicker-it.js"></script>
<script>
$(function(){
        $('#datepicker').datepicker({
            inline: true,
            showOtherMonths: true,
	    	dateFormat: "yy-mm-dd",
        });
        $.datepicker.setDefaults($.datepicker.regional['it']);
    });
</script>
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
echo '<br>'.$objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"].'<br><br>';
}
mysql_close($objConnect);
?>

<div class="tools-alert tools-alert-green animated bounce" align="left">
<h4>Se devi registrare attività riconosciute in modo forfetario, vai a <a href="forfait.php"><font color="#297ACC">questa pagina</font></a>.</h4>
</div>

<div class="units-row">
<div class="unit-centered unit-80">

<br>
 <h3 align="center">Registra un'attività che hai svolto - data</h3>
<br>

<div class="tools-alert tools-alert-yellow" align="left">
<font color="#4D94FF"><b>Ricorda che i Consigli di Classe di gennaio e giugno (scrutini) e le udienze individuali sono atti dovuti, e NON devono essere registrati.</b></font>
</div>

<br>

<div class="ui-widget" align="left">

<form action="ore2.php" method="POST" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" class="forms">
<div class="table-container" align="center">
<table>
 <tr>
  <td>
&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona dal calendario la <font color="#6D8D4D"><b>data</b></font> (<i>AAAA-MM-GG</i>) in cui hai svolto l'attività:
</td>
<td>
<input type="text" id="datepicker" name="calendario" placeholder="ad es. 2015-09-30" />
</td>
 </tr>
</table>
<div align="left" class="forms-desc">
(se con Explorer non vedi il calendario, premi F12 e seleziona "modalità documento: standard di Internet Explorer")
</div>
</div>
<div align="center">
<input type="submit" name="invia" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" value="prosegui >>" class="btn btn-round width-30" />
</div>
</form>
</div>

<div align="left">
<?
$aaa = 166.7;
echo '<label>avanzamento:  </label><span class="bar" style="background-position: -'.$aaa.'px 0;">1 di 6</span>';
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

</body>
</html>