<?php
//let's start the session
session_start();

//now, let's register our session variables
session_register('ora_ini');
session_register('min_ini');
session_register('ora_fine');
session_register('min_fine');
//finally, let's store our posted values in the session variables
$_SESSION['ora_ini'] = $_POST['ora_ini'];
$_SESSION['min_ini'] = $_POST['min_ini'];
$_SESSION['ora_fine'] = $_POST['ora_fine'];
$_SESSION['min_fine'] = $_POST['min_fine'];
$durata=(((($_SESSION['ora_fine']*60)+($_SESSION['min_fine']))-(($_SESSION['ora_ini']*60)+($_SESSION['min_ini'])))/60);
?>
<!DOCTYPE html>
<html>
<head>
<title>inserimento 3/6</title>
 
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
<script>
$(function() {
var availableTags = [
"assemblea",
"Collegio docenti",
"colloquio con",
"conferenza",
"Consiglio di classe",
"corso",
"corso di aggiornamento",
"corso di alfabetizzazione",
"corso di recupero carenze",
"corso di sostegno",
"esami di idoneità",
"incontro con",
"incontro con coordinatori",
"incontro di orientamento",
"laboratorio di",
"lezione",
"lezione CLIL",
"lezione in laboratorio con",
"lezione itinerante con",
"organizzazione di",
"progetto",
"progetto multidisciplinare",
"programmazione",
"riunione",
"riunione di commissione",
"riunione di dipartimento",
"riunione di gruppo di lavoro",
"riunione di progetto",
"riunione di programmazione con colleghi",
"simulazione di",
"sorveglianza",
"sostituzione di collega assente",
"sportello didattico",
"udienze generali",
"udienze individuali",
"uscita con",
"visita presso"
];
$( "#desc" ).autocomplete({
source: availableTags
});
});
</script>
  <script src="jquery/external/jquery/jquery.js"></script>
  <script src="jquery/jquery-ui.js"></script>
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
if (!$_SESSION['ora_ini'] or !$_SESSION['min_ini'] or !$_SESSION['ora_fine'] or !$_SESSION['min_fine'])
{
echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."E' impossibile procedere perché non hai inserito un orario di inizio e/o fine completo.".'<br><br>'."Per favore torna indietro e completa tutti i campi.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
}
else
 if ((strlen($_SESSION['ora_ini'])>2) or (strlen($_SESSION['min_ini'])>2) or (strlen($_SESSION['ora_fine'])>2) or (strlen($_SESSION['min_fine'])>2))
  {
  	echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."C'è qualcosa di strano nell'ORARIO che hai indicato. Sono ammesse solo due cifre.".'<br><br>'."Non è possibile procedere. Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if (((!ctype_digit($_SESSION['ora_ini'])) or $_SESSION['ora_ini']<0 or $_SESSION['ora_ini']>23) or ((!ctype_digit($_SESSION['min_ini'])) or $_SESSION['min_ini']<0 or $_SESSION['min_ini']>59) or ((!ctype_digit($_SESSION['ora_fine'])) or $_SESSION['ora_fine']<0 or $_SESSION['ora_fine']>23) or ((!ctype_digit($_SESSION['min_fine'])) or $_SESSION['min_fine']<0 or $_SESSION['min_fine']>59))
  {
  	echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."C'è qualcosa di strano negli ORARI che hai indicato. Sono ammessi solo numeri interi compresi tra 0 e 23 (per le ORE) e tra 0 e 59 (per i MINUTI).".'<br><br>'."Non è possibile procedere. Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ($durata <= 0)
  {
  	echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."C'è qualcosa di strano nell'ORARIO che hai indicato. La DURATA di questa attività è nulla o negativa.".'<br><br>'."Non è possibile procedere. Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((ctype_digit($_SESSION['ora_ini'])) && (ctype_digit($_SESSION['min_ini'])) && (ctype_digit($_SESSION['ora_fine'])) && (ctype_digit($_SESSION['min_fine'])))
   {
?>
<br>
 <h3 align="center">Registra un'attività che hai svolto - attività</h3>
<br><br>

<div class="ui-widget" align="left">
<form action="ore4.php" method="POST" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" class="forms">

<div class="table-container" align="center">
<table>
 <tr>
  <td>
&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;<font color="#6D8D4D"><b>Descrivi</b></font> brevemente l'attività svolta:
  </td>
  <td>
<input id="desc" type="text" name="descrizione" class="width-70" maxlength="60" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;size: 13px;" placeholder="cosa hai fatto?" />
  </td>
 </tr>
 </table>
</div>
<div align="center">
<input type="submit" name="invia" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" value="prosegui >>" class="btn btn-round width-30" />
</div>
</form>
</div>

<div align="left">
<?
$aaa = 100;
echo '<label>avanzamento:  </label><span class="bar" style="background-position: -'.$aaa.'px 0;">3 di 6</span>';
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
  else
  {
 	 echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."E' impossibile procedere. Nei campi dell'ora di INIZIO e FINE attività si possono inserire solo numeri interi.".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore1.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
?>
</body>
</html>