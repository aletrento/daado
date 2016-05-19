<!DOCTYPE html>
<html>
<head>
<title>gradimento</title>
 
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
<body>

<nav class="navbar navbar-pills">
 <ul>
  <li><a href="intro.php"><img src="img/what.png" width="35" height="35" alt="intro"></a></li>
  <li><a href="index.php"><img src="img/signin.png" width="35" height="35" alt="accedi"></a></li>
  <li><a href="registrazione.php"><img src="img/signup.png" width="35" height="35" alt="iscriviti"></a></li>
  <li><a href="info.php"><img src="img/pie.png" width="35" height="35" alt="numeri"></a></li>
  <li><a href="files.php"><img src="img/share.png" width="35" height="35" alt="condividi"></a></li>
 </ul>
</nav>

<div class="units-row">
<div class="unit-centered unit-80">

 <h1 align="center"><font color="#B8A08A">D</font>.<font color="#FFB870">A</font>.<font color="#9ABA88">A</font>.<font color="#ADC2FF">DO</font>.</h1>
 <h2 align="center"><font color="#B8A08A">D</font>atabase delle <font color="#FFB870">A</font>ttività <font color="#9ABA88">A</font>ggiuntive dei <font color="#ADC2FF">DO</font>centi</h2>

<br><br>

 <h3 align="center">Cosa dicono gli utenti</h3>
 
<br>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database.");
$objDB = mysql_select_db("my_daado");
?>

<div align="left">
... questi sono i risultati del questionario proposto agli utenti registrati:
</div>

<br><br>

<center>
<div class="table-container">
<table class="table-hovered">
 <tr>
  <th class="text-centered highlight">Quesiti</th>
  <th class="text-centered highlight">Risposta più frequente</th>
 </tr>
 <tr>
  <td class="text-left">Nel complesso, ti piace questo sito?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q1` FROM `questionario` GROUP BY `q1` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q1]";?>
  </td>
 </tr>
 <tr>
  <td class="text-left">Qual è la tua opinione riguardo l'usabilità di D.A.A.DO.?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q2` FROM `questionario` GROUP BY `q2` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q2]";?>
  </td>
 </tr>
 <tr>
  <td class="text-left">Che cosa pensi della veste grafica?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q3` FROM `questionario` GROUP BY `q3` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q3]";?>
  </td>
 </tr>
 <tr>
  <td class="text-left">Hai avuto delle difficoltà nelle procedure di salvataggio, modifica e cancellazione dei dati?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q4` FROM `questionario` GROUP BY `q4` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q4]";?>
  </td>
 </tr>
 <tr>
  <td class="text-left">Che cosa pensi della tabella con il consuntivo finale (pagina "somme")?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q5` FROM `questionario` GROUP BY `q5` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q5]";?>
  </td>
 </tr>
 <tr>
  <td class="text-left">La lista dei tag proposti (per la descrizione delle attività svolte) è esaustiva?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q6` FROM `questionario` GROUP BY `q6` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q6]";?>
  </td>
 </tr>
 <tr>
  <td class="text-left">L'inserimento dei dati è sufficientemente rapido?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q7` FROM `questionario` GROUP BY `q7` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q7]";?>
  </td>
 </tr>
 <tr>
  <td class="text-left">Questo sito ha facilitato il monitoraggio delle tue attività aggiuntive?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q8` FROM `questionario` GROUP BY `q8` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q8]";?>
  </td>
 </tr>
 <tr>
  <td class="text-left">Consiglieresti questo sito a qualche tua/o collega?</td>
  <td class="text-left"><?$top = mysql_query("SELECT `q9` FROM `questionario` GROUP BY `q9` ORDER BY COUNT(*) DESC LIMIT 1;");
$riga = mysql_fetch_assoc($top);
echo "$riga[q9]";?>
  </td>
 </tr>
</table>
</div>
</center>

<?
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>