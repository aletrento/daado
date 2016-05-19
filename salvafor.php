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

 <h3 align="center">Conferma modifica evento forfetario</h3>
 
<br><br>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$utente=$_SESSION["username"];
$forfait=mysql_real_escape_string($_POST["forfait"]);
$descrizione=mysql_real_escape_string($_POST["descrizione"]);
$categoria=$_POST["categoria"];
$tipo=$_POST["tipo"];
$tag=$_POST["tag"];

if (!$forfait or !$descrizione or !$categoria or !$tipo or !$tag)
{
echo '<div class="tools-alert tools-alert-red">'."Impossibile salvare i tuoi dati perché HAI LASCIATO QUALCHE CAMPO VUOTO O QUALCHE VALORE UGUALE A ZERO.".'<br>'."Per favore torna indietro e completa.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
}
else
  if ((strlen($forfait)>2))
  {
  	echo '<div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nella DURATA che hai indicato. Sono ammessi solo numeri interi di due cifre.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ($categoria!=='80' && $categoria!=='40' && $categoria!=='70' && $categoria!=='dubbie' && $categoria!=='fondo')
  {
  	echo '<div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nella CATEGORIA che hai indicato. Sono ammessi solo i seguenti valori: 80, 40, 70, fondo, dubbie.".'<br>'."Per favore torna indietro e correggi (facendo riferimento alla legenda).".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ($tipo!=='f' && $tipo!=='nf')
  {
  	echo '<div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nel TIPO che hai indicato. Sono ammessi solo due valori in questo campo: f o nf.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((!ctype_digit($tag)) or $tag<1 or $tag>=25)
  {
  	  echo '<div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nel TAG che hai indicato. Sono ammessi solo numeri interi compresi tra 1 e 24.".'<br>'."Per favore torna indietro e correggi (facendo riferimento alla legenda).".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
else
 if ((ctype_digit($forfait)))
  {
$sql="UPDATE eventi SET utente='$utente', forfait='$forfait', descrizione='$descrizione', categoria='$categoria', tipo='$tipo', tag='$tag' WHERE id='".$_GET["id"]."' ";
$update=mysql_query($sql);
echo '<div class="tools-alert tools-alert-green">'."Modifica effettuata correttamente.".'</div>';
//$descrizione=$_POST["descrizione"];
$dup = mysql_query("SELECT descrizione FROM eventi WHERE utente='{$_SESSION['username']}' AND descrizione='".$_POST['descrizione']."' ");
        if(mysql_num_rows($dup) >1)
        {
            echo '<br><br><div class="tools-alert tools-alert-yellow">'."Tuttavia, sono già state salvate delle attività con la stessa descrizione. Controlla che non sia un ".'<b>'."duplicato".'</b>'.".".'</div>';
        }
        else
        {
            echo '<br><br><div class="tools-alert tools-alert-green">'."Questa è la prima attività registrata con questa descrizione.".'</div>';
        }
 }
  else
  {
 	 echo '<div class="tools-alert tools-alert-red">'."Impossibile salvare. Nel campo 'durata' si possono inserire solo numeri interi positivi.".'<br>'."Per favore torna indietro e correggi.".'</div><center><a href="modifica.php?id='.$_GET["id"].'"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
  }
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>