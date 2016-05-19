<!DOCTYPE html>
<html>
<head>
<title>conferma modifica</title>
 
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
?>
<?php echo $objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"];?>
<br>
<?php echo "scuola: ".$objResult["scuola"];?>
<br>
<?php echo "disciplina: ".$objResult["materia"];?>
<br>
<?php echo "a.s.: ".$objResult["anno"];?>
<?
}
mysql_close($objConnect);
?>

<div class="units-row">
<div class="unit-centered unit-80">

<div align="right">
Torna alla tabella di <a href="tabella.php">riepilogo</a>.
</div>

<br><br>

 <h3 align="center">Conferma modifica</h3>
 
<br><br>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$utente=$_SESSION["username"];
$giorno=mysql_real_escape_string($_POST["giorno"]);
$mese=mysql_real_escape_string($_POST["mese"]);
$anno=mysql_real_escape_string($_POST["anno"]);
$ora_ini=mysql_real_escape_string($_POST["ora_ini"]);
$min_ini=mysql_real_escape_string($_POST["min_ini"]);
$ora_fine=mysql_real_escape_string($_POST["ora_fine"]);
$min_fine=mysql_real_escape_string($_POST["min_fine"]);
$durata=(((($ora_fine*60)+($min_fine))-(($ora_ini*60)+($min_ini)))/60);
$forfait=mysql_real_escape_string($_POST["forfait"]);
$descrizione=mysql_real_escape_string($_POST["descrizione"]);
$categoria=mysql_real_escape_string($_POST["categoria"]);
$tipo=mysql_real_escape_string($_POST["tipo"]);
$tag=mysql_real_escape_string($_POST["tag"]);

if (!$giorno or !$mese or !$anno or !$descrizione or !$categoria or !$tipo or !$tag)
{
echo '<br><div class="tools-alert tools-alert-red">'."Impossibile salvare i tuoi dati perché HAI LASCIATO QUALCHE CAMPO VUOTO O QUALCHE VALORE UGUALE A ZERO.".'<br>'."Per favore torna indietro e completa.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
}
else
 if ((!ctype_digit($giorno)) or $giorno<1 or $giorno>=32)
  {
  	echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nel GIORNO che hai indicato. Sono ammessi solo numeri interi compresi tra 1 e 31.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((!ctype_digit($mese)) or $mese<1 or $mese>=13)
  {
  	echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nel MESE che hai indicato. Sono ammessi solo numeri interi compresi tra 1 e 12.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((!ctype_digit($anno)) or $anno<2015 or $anno>2016)
  {
  	  echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nell'ANNO che hai indicato. Sono ammessi solo due valori in questo campo: 2015 o 2016.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ($categoria!=='80' && $categoria!=='40' && $categoria!=='70' && $categoria!=='dubbie' && $categoria!=='fondo')
  {
  	  echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nella CATEGORIA che hai indicato. Sono ammessi solo i seguenti valori: 80, 40, 70, fondo, dubbie.".'<br>'."Per favore torna indietro e correggi (facendo riferimento alla legenda).".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ($tipo!=='f' && $tipo!=='nf')
  {
  	  echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nel TIPO che hai indicato. Sono ammessi solo due valori in questo campo: f oppure nf.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((!ctype_digit($tag)) or $tag<1 or $tag>=25)
  {
  	  echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nel TAG che hai indicato. Sono ammessi solo numeri interi compresi tra 1 e 24.".'<br>'."Per favore torna indietro e correggi (facendo riferimento alla legenda).".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if (((!ctype_digit($ora_ini)) or $ora_ini<0 or $ora_ini>23) or ((!ctype_digit($min_ini)) or $min_ini<0 or $min_ini>59) or ((!ctype_digit($ora_fine)) or $ora_fine<0 or $ora_fine>23) or ((!ctype_digit($min_fine)) or $min_fine<0 or $min_fine>59))
  {
  	  echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano negli ORARI che hai indicato. Sono ammessi solo numeri interi compresi tra 0 e 23 (per le ore) e tra 0 e 59 (per i minuti).".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((strlen($ora_ini)>2) or (strlen($min_ini)>2) or (strlen($ora_fine)>2) or (strlen($min_fine)>2))
  {
  	echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nell'ORARIO che hai indicato. Sono ammessi solo numeri interi di due cifre.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ($durata <= 0)
  {
  	echo '<br><div class="tools-alert tools-alert-red">'."Errore:".'<br>'."c'è qualcosa di strano nell'ORARIO che hai indicato. La durata di questa attività è nulla o negativa.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((ctype_digit($ora_ini)) && (ctype_digit($min_ini)) && (ctype_digit($ora_fine)) && (ctype_digit($min_fine)))
   {
$sql="UPDATE eventi SET utente='$utente', giorno='$giorno', mese='$mese', anno='$anno', ora_ini='$ora_ini', min_ini='$min_ini', ora_fine='$ora_fine', min_fine='$min_fine', forfait='$forfait', descrizione='$descrizione', categoria='$categoria', tipo='$tipo', tag='$tag' WHERE id='".$_GET["id"]."' ";
$update=mysql_query($sql);
echo '<div class="tools-alert tools-alert-green">'."Modifica effettuata correttamente.".'</div><br>';

$giorno=$_POST["giorno"];
$mese=$_POST["mese"];
$anno=$_POST["anno"];
$dup = mysql_query("SELECT giorno AND mese AND anno FROM eventi WHERE utente='{$_SESSION['username']}' AND giorno='".$_POST['giorno']."' AND mese='".$_POST['mese']."' AND anno='".$_POST['anno']."' ");
        if(mysql_num_rows($dup) >1)
        {
            echo '<div class="tools-alert tools-alert-yellow">'."Tuttavia, sono già state salvate delle attività per questo giorno. Controlla che non sia un ".'<i>'."duplicato".'</i>'.".".'</div>';
        }
        else
        {
            echo '<div class="tools-alert tools-alert-green">'."Questa è la prima attività registrata per questo giorno.".'</div>';
        }
 }
  else
  {
 	 echo '<br><div class="tools-alert tools-alert-red">'."Impossibile salvare. Nei campi dell'ora di inizio e fine attività si possono inserire solo numeri interi.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>