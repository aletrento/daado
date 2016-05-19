<!DOCTYPE html>
<html>
<head>
<title>questionario</title>
 
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
Visualizza la <a href="tabella.php">tabella</a> con tutte le attività che hai registrato finora.
</div>

<br><br>

 <h3 align="center">Questionario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/que.png" width="80" height="100" title="questionario" align="middle"></h3>
 
<br>

<div align="left" class="tools-alert tools-alert-yellow">
Questo questionario è rivolto a chi ha già provato ad utilizzare D.A.A.DO.<br>
Se hai appena effettuato la registrazione, aspetta. Potrai compilarlo più avanti, ma una volta soltanto.<br>
La tua opinione è importante, e con le tue risposte puoi contribuire a migliorare il sito. Grazie mille!
</div>

<br>

<form action="consegna.php" method="POST" class="forms">
<div class="table-container" align="center">
<table>
 <tr>
  <td>Nel complesso, ti piace questo sito?<br>
   <select name="q1">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="Sì, molto."> Sì, molto.
    <option value="Sì, abbastanza."> Sì, abbastanza.
    <option value="No, non molto."> No, non molto.
    <option value="No, per nulla."> No, per nulla.
   </select>
  </td>
 </tr>
 <tr>
  <td>Qual è la tua opinione riguardo l'usabilità di D.A.A.DO.?<br>
   <select name="q2">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="E' molto facile da usare."> E' molto facile da usare.
    <option value="Abbastanza facile."> Abbastanza facile.
    <option value="Piuttosto difficile."> Piuttosto difficile.
    <option value="La struttura del sito è molto contorta e disorientante."> La struttura del sito è molto contorta e disorientante.
   </select>
  </td>
 </tr>
 <tr>
  <td>Che cosa pensi della veste grafica?<br>
   <select name="q3">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="E' molto gradevole e chiara."> E' molto gradevole e chiara.
    <option value="Gradevole, ma un po' banale."> Gradevole, ma un po' banale.
    <option value="Non è molto originale. Andrebbe migliorata."> Non è molto originale. Andrebbe migliorata.
    <option value="Decisamente brutta e scontata."> Decisamente brutta e scontata.
   </select>
  </td>
 </tr>
 <tr>
  <td>Hai avuto delle difficoltà nelle procedure di salvataggio, modifica e cancellazione dei dati?<br>
   <select name="q4">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="No, era tutto chiaro fin dall'inizio."> No, era tutto chiaro fin dall'inizio.
    <option value="All'inizio non capivo bene come fare."> All'inizio non capivo bene come fare.
    <option value="Ho ancora dei dubbi. Alcuni passaggi non sono chiari."> Ho ancora dei dubbi. Alcuni passaggi non sono chiari.
    <option value="Non riesco ancora a salvare e modificare i miei dati."> Non riesco ancora a salvare e modificare i miei dati.
   </select>
  </td>
 </tr>
 <tr>
  <td>Che cosa pensi della tabella con il consuntivo finale (pagina "somme")?<br>
   <select name="q5">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="Molto leggibile e completa."> Molto leggibile e completa.
    <option value="Abbastanza chiara, ma con troppe informazioni."> Abbastanza chiara, ma con troppe informazioni.
    <option value="Poco chiara, faticosa da leggere."> Poco chiara, faticosa da leggere.
    <option value="Non riesco proprio ad interpretarla."> Non riesco proprio ad interpretarla.
   </select>
  </td>
 </tr>
 <tr>
  <td>La lista dei tag proposti (per la descrizione delle attività svolte) è esaustiva?<br>
   <select name="q6">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="Certo. Ho potuto salvare tutte le attività svolte."> Certo. Ho potuto salvare tutte le attività svolte.
    <option value="Talvolta ho dovuto scegliere il tag generico 'altre attività'."> Talvolta ho dovuto scegliere il tag generico "altre attività".
    <option value="Diverse attività che svolgo a scuola non sono contemplate dal sistema."> Diverse attività che svolgo a scuola non sono contemplate dal sistema.
    <option value="E' un disastro! La lista è incompleta."> E' un disastro! La lista è incompleta.
   </select>
  </td>
 </tr>
 <tr>
  <td>L'inserimento dei dati è sufficientemente rapido?<br>
   <select name="q7">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="Sì. E' molto veloce."> Sì. E' molto veloce.
    <option value="Non è veloce, ma tutte le informazioni da dare sono utili."> Non è veloce, ma tutte le informazioni da dare sono utili.
    <option value="E' un po' laborioso. Alcuni dati non sono necessari."> E' un po' laborioso. Alcuni dati non sono necessari.
    <option value="Vengono chieste troppe informazioni. La procedura andrebbe snellita."> Vengono chieste troppe informazioni. La procedura andrebbe snellita.
   </select>
  </td>
 </tr>
 <tr>
  <td>Questo sito ha facilitato il monitoraggio delle tue attività aggiuntive?<br>
   <select name="q8">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="Molto. Prima impiegavo molto più tempo."> Molto. Prima impiegavo molto più tempo.
    <option value="Non di molto. Ma è sicuramente comodo."> Non di molto. Ma è sicuramente comodo.
    <option value="No, richiede troppo tempo."> No, richiede troppo tempo.
    <option value="Una volta segnavo tutto a mano, ed era molto meglio!"> Una volta segnavo tutto a mano, ed era molto meglio!
   </select>
  </td>
 </tr>
 <tr>
  <td>Consiglieresti questo sito a qualche tua/o collega?<br>
   <select name="q9">
    <option value="" disabled selected style='display:none;'> - scegli -
    <option value="Certo! L'ho già fatto."> Certo! L'ho già fatto.
    <option value="Forse sì, ma non è una risorsa importante per noi docenti."> Forse sì, ma non è una risorsa importante per noi docenti.
    <option value="Non credo. Non l'ho trovato molto comodo e utile."> Non credo. Non l'ho trovato molto comodo e utile.
    <option value="Assolutamente no."> Assolutamente no.
   </select>
  </td>
 </tr>
</table>
</div>
<div align="center">
<input type="submit" name="spedisci" value="invia le tue risposte" class="btn btn-round" />
</div>
</form>

</div>
</div>

</body>
</html>