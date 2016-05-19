<?php
//let's start the session
session_start();
//now, let's register our session variables
session_register('calendario');
//finally, let's store our posted values in the session variables
$_SESSION['calendario'] = $_POST['calendario'];
$cal=explode("-", $_SESSION['calendario']);
$anno=$cal[0];
$mese=$cal[1];
$giorno=$cal[2];
?>
<!DOCTYPE html>
<html>
<head>
<title>inserimento 2/6</title>
 
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
if (!$_SESSION['calendario'])
{
echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."E' impossibile procedere perché non hai inserito una data.".'<br><br>'."Per favore torna indietro e completa.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
}
else
 if ((strlen($giorno)>2) or $giorno<0 or $giorno>31 or (strlen($mese)>2) or $mese<0 or $mese>12 or (strlen($anno)<4) or (strlen($anno)>4) or $anno<2015 or $anno>2016)
  {
  	echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."E' impossibile procedere perché c'è qualcosa di strano nella DATA che hai indicato. Forse hai selezionato un giorno che non è nel corrente anno scolastico?".'<br>'."Forse hai inserito la DATA manualmente e non hai utilizzato il formato corretto (YYYY-MM-DD, ad es. 2015-09-23)?".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
  {
?>
<br>
 <h3 align="center">Registra un'attività che hai svolto - orario</h3>
<br><br>


<form action="ore3.php" method="POST" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" class="forms">
&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Scrivi l'<font color="#6D8D4D"><b>orario</b></font> dell'attività che hai svolto <small>(in formato 24 ore)</small>:
<br>
<div class="units-row">
 <div class="unit-10"></div>
 <div class="unit-90">
 <div class="table-container" align="center">
   <table class="table-simple">
    <tbody>
     <tr>
      <td>inizio attività</td>
      <td>ora: <input type="text" name="ora_ini" maxlength="2" placeholder="ad es. 14" /></td>
      <td>minuti: <input type="text" name="min_ini" maxlength="2" placeholder="ad es. 20" /></td>
     </tr>
     <tr>
      <td>fine attività</td>
      <td>ora: <input type="text" name="ora_fine" maxlength="2" placeholder="ad es. 16" /></td>
      <td>minuti: <input type="text" name="min_fine" maxlength="2" placeholder="ad es. 35" /></td>
     </tr>
    </tbody>
   </table>
 </div>
 </div>
</div>
<div align="center">
<input type="submit" name="invia" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" value="prosegui >>" class="btn btn-round width-30" />
</div>
</form>

<div align="left">
<?
$aaa = 133.4;
echo '<label>avanzamento:  </label><span class="bar" style="background-position: -'.$aaa.'px 0;">2 di 6</span>';
?>
</div>

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