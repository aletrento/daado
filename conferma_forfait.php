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

 <h3 align="center">Conferma salvataggio dati - attività forfetaria</h3>

<br><br>

<?php
mysql_connect("", "", "") or die(mysql_error());
mysql_select_db("my_daado") or die(mysql_error());
$utente=$_SESSION["username"];
$forfait=mysql_real_escape_string($_POST["forfait"]);
$descrizione=mysql_real_escape_string($_POST["descrizione"]);
$categoria=$_POST["categoria"];
$tipo=$_POST["tipo"];
$tag=$_POST["tag"];
if (!$descrizione or !$categoria or !$tipo or !$tag)
{
echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."impossibile salvare i tuoi dati perché hai lasciato qualche campo vuoto.".'<br>'."Per favore torna indietro e completa.".'</div>';
}
else
 if ((!ctype_digit($forfait)) or $forfait<=0)
  {
  	echo '<div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nella DURATA che hai indicato. Sono ammessi solo numeri interi compresi tra 1 e 99.".'<br>'."Per favore torna indietro e correggi.".'</div>';
  }
else
 if ((ctype_digit($forfait)))
 {
mysql_query("INSERT INTO eventi (utente,forfait,descrizione,categoria,tipo,tag) VALUES ('$utente','$forfait','$descrizione','$_POST[categoria]','$_POST[tipo]','$_POST[tag]') ") or die(mysql_error());
echo '<div class="tools-alert tools-alert-green">'."I dati che hai inserito sono stati salvati correttamente.".'</div><br>';
$dup = mysql_query("SELECT descrizione FROM eventi WHERE utente='{$_SESSION['username']}' AND descrizione='".$_POST['descrizione']."' ");
        if(mysql_num_rows($dup) >1)
        {
            echo '<div class="tools-alert tools-alert-yellow">'."Tuttavia, sono già state salvate delle attività con questa descrizione. Controlla che non sia un ".'<u>'."duplicato".'</u>'.".".'</div><br><br>';
        }
        else
        {
            echo '<div class="tools-alert tools-alert-green">'."Questa è la prima volta che inserisci delle attività svolte forfetarie con questa descrizione.".'</div><br><br>';
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
	echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."impossibile salvare. Nel campo numero ore si possono inserire solo numeri interi.".'<br>'."Per favore torna indietro e controlla.".'</div>';
}
mysql_close();
?>

</div>
</div>

</body>
</html>