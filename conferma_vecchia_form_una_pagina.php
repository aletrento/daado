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

$calendario=$_POST["calendario"];
$cal=explode("-", $calendario);
$utente=$_SESSION["username"];
$anno=$cal[0];
$mese=$cal[1];
$giorno=$cal[2];
$ora_ini=mysql_real_escape_string($_POST["ora_ini"]);
$min_ini=mysql_real_escape_string($_POST["min_ini"]);
$ora_fine=mysql_real_escape_string($_POST["ora_fine"]);
$min_fine=mysql_real_escape_string($_POST["min_fine"]);
$durata=(((($ora_fine*60)+($min_fine))-(($ora_ini*60)+($min_ini)))/60);
$descrizione=mysql_real_escape_string($_POST["descrizione"]);
$categoria=$_POST["categoria"];
$tipo=$_POST["tipo"];
$tag=$_POST["tag"];
if (!$giorno or !$mese or !$anno or !$descrizione or !$categoria or !$tipo or !$tag)
{
echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."Impossibile salvare i tuoi dati perché hai lasciato qualche CAMPO VUOTO.".'<br>'."Oppure hai inserito la DATA manualmente e non hai utilizzato il formato corretto (YYYY-MM-DD, ad es. 2015-09-23)".'<br><br>'."Per favore torna indietro e completa.".'</div><br><br><center><a href="ore.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
}
else
 if ((strlen($giorno)>2) or $giorno<0 or $giorno>31 or (strlen($mese)>2) or $mese<0 or $mese>12 or (strlen($anno)<4) or (strlen($anno)>4) or $anno<2015 or $anno>2016)
  {
  	echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."C'è qualcosa di strano nella DATA che hai indicato. Forse hai selezionato un giorno che non è nel corrente anno scolastico?".'<br>'."Forse hai inserito la DATA manualmente e non hai utilizzato il formato corretto (YYYY-MM-DD, ad es. 2015-09-23)?".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((strlen($ora_ini)>2) or (strlen($min_ini)>2) or (strlen($ora_fine)>2) or (strlen($min_fine)>2))
  {
  	echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."C'è qualcosa di strano nell'ORARIO che hai indicato. Sono ammesse solo due cifre.".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if (((!ctype_digit($ora_ini)) or $ora_ini<0 or $ora_ini>23) or ((!ctype_digit($min_ini)) or $min_ini<0 or $min_ini>59) or ((!ctype_digit($ora_fine)) or $ora_fine<0 or $ora_fine>23) or ((!ctype_digit($min_fine)) or $min_fine<0 or $min_fine>59))
  {
  	echo '<div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano negli ORARI che hai indicato. Sono ammessi solo numeri interi compresi tra 0 e 23 (per le ORE) e tra 0 e 59 (per i MINUTI).".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ($durata <= 0)
  {
  	echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."C'è qualcosa di strano nell'ORARIO che hai indicato. La DURATA di questa attività è nulla o negativa.".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br><center><a href="ore.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((ctype_digit($ora_ini)) && (ctype_digit($min_ini)) && (ctype_digit($ora_fine)) && (ctype_digit($min_fine)))
   {
        mysql_query("INSERT INTO eventi (utente,giorno,mese,anno,ora_ini,min_ini,ora_fine,min_fine,descrizione,categoria,tipo,tag) VALUES ('$utente','$giorno','$mese','$anno','$ora_ini','$min_ini','$ora_fine','$min_fine','$descrizione','$_POST[categoria]','$_POST[tipo]','$_POST[tag]') ") or die(mysql_error());
        echo '<div class="tools-alert tools-alert-green">'."I dati che hai inserito sono stati salvati correttamente.".'</div><br>';
        $dup = mysql_query("SELECT giorno AND mese AND anno FROM eventi WHERE utente='{$_SESSION['username']}' AND giorno='".$giorno."' AND mese='".$mese."' AND anno='".$anno."' ");
        if(mysql_num_rows($dup) >1)
        {
            echo '<div class="tools-alert tools-alert-yellow">'."Tuttavia, sono già state salvate delle attività per questo giorno. Controlla che non sia un ".'<u>'."duplicato".'</u>'.".".'</div><br><br>';
        }
        else
        {
            echo '<div class="tools-alert tools-alert-green">'."Questa è la prima attività registrata per questo giorno.".'</div><br><br>';
        }
?>

<div align="left">
<a href="ore.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro" align="center"></a> Se vuoi inserirne altri, torna indietro.
</div>

<br><br>

<div align="left">
Se hai terminato, controlla la <a href="tabella.php">tabella</a> con tutti i dati che hai salvato finora e verifica la situazione attuale (<a href="maths.php">totale ore</a>).
</div>

<?php
 }
  else
  {
 	 echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."impossibile salvare. Nei campi dell'ora di INIZIO e FINE attività si possono inserire solo numeri interi.".'<br><br>'."Per favore torna indietro e controlla.".'</div><br><br><center><a href="ore.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
mysql_close();
?>

</div>
</div>

</body>
</html>