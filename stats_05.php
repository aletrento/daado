<!DOCTYPE html>
<html>
<head>
<title>statistiche</title>
 
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
?>
(oggi è il giorno: <?php echo (date("d-m-y"));?>)

<div class="units-row">
<div class="unit-centered unit-80">

<br><br>

<div align="left">
<a href="statistiche.php"><img src="img/arrow_indietro.png" width="70" height="35" title="indietro"></a>
</div>

<br><br>

<h3 align="center">Statistiche (5/7)</h3>

<br><br>

<div class="tools-alert" align="left">
Se hai caricato attività sul FUIS, come sono distribuite?
<br><br>
Questo grafico mostra come sono distribuite le attività che hai registrato sul fondo d'istituto.<br>
Se al posto del grafico vedi un <b>messaggio di errore</b>, significa che non hai ancora caricato attività sul FUIS.<br>
<small>Per salvare l'immagine: click tasto destro --> "salva immagine con nome".</small>
</div>

<br><br>

<div align="center">
<figure>
<img src="grafico_05.php" />
</figure>
</div>

<div class="table-container" align="center">
<table class="table-stripped">
 <tr>
  <th class="text-centered highlight">nr. tag</th>
  <th class="text-centered highlight">significato</th>
  <th class="text-centered highlight">nr. tag</th>
  <th class="text-centered highlight">significato</th>
 </tr>
 <tr>
  <td class="text-centered">1</td>
  <td class="text-left">Collegio docenti</td>
  <td class="text-centered">2</td>
  <td class="text-left">Consiglio di classe</td>
 </tr>
 <tr>
  <td class="text-centered">3</td>
  <td class="text-left">riunione di dipartimento</td>
  <td class="text-centered">4</td>
  <td class="text-left">sostituzione collega assente</td>
 </tr>
 <tr>
  <td class="text-centered">5</td>
  <td class="text-left">udienze</td>
  <td class="text-centered">6</td>
  <td class="text-left">corso di aggiornamento</td>
 </tr>
 <tr>
  <td class="text-centered">7</td>
  <td class="text-left">corso di recupero carenze (ed esami idoneità)</td>
  <td class="text-centered">8</td>
  <td class="text-left">sportello disciplinare</td>
 </tr>
 <tr>
  <td class="text-centered">9</td>
  <td class="text-left">corso extracurricolare (sostegno, CLIL, ecc.)</td>
  <td class="text-centered">10</td>
  <td class="text-left">lezione itinerante</td>
 </tr>
 <tr>
  <td class="text-centered">11</td>
  <td class="text-left">programmazione con colleghi</td>
  <td class="text-centered">12</td>
  <td class="text-left">riunione di progetto/commissione</td>
 </tr>
 <tr>
  <td class="text-centered">13</td>
  <td class="text-left">sorveglianza</td>
  <td class="text-centered">14</td>
  <td class="text-left">altro</td>
 </tr>
 <tr>
  <td class="text-centered">15</td>
  <td class="text-left">verbalista (forfait)</td>
  <td class="text-centered">16</td>
  <td class="text-left">coordinatore di classe (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">17</td>
  <td class="text-left">coordinatore di dipartimento (forfait)</td>
  <td class="text-centered">18</td>
  <td class="text-left">tutoraggio (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">19</td>
  <td class="text-left">responsabile di laboratorio (forfait)</td>
  <td class="text-centered">20</td>
  <td class="text-left">responsabile/referente di progetto (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">21</td>
  <td class="text-left">responsabile di commissione (forfait)</td>
  <td class="text-centered">22</td>
  <td class="text-left">funzione strumentale (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">23</td>
  <td class="text-left">collaboratore del Dirigente (forfait)</td>
  <td class="text-centered">24</td>
  <td class="text-left">uscita o viaggio d'istruzione (forfait)</td>
 </tr>
</table>
</div>

</div>
</div>

</body>
</html>
