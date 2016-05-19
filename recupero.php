<!DOCTYPE html>
<html>
<head>
<title>recupero</title>
 
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
  <li><a href="info.php"><img src="img/pie.png" width="35" height="35" alt="numeri"></a></li>
  <li><a href="files.php"><img src="img/share.png" width="35" height="35" alt="condividi"></a></li>
 </ul>
</nav>

<div class="units-row">
<div class="unit-centered unit-80">

  <h1 align="center"><font color="#B8A08A">D</font>.<font color="#FFB870">A</font>.<font color="#9ABA88">A</font>.<font color="#ADC2FF">DO</font>.</h1>
  <h2 align="center"><font color="#B8A08A">D</font>atabase delle <font color="#FFB870">A</font>ttività <font color="#9ABA88">A</font>ggiuntive dei <font color="#ADC2FF">DO</font>centi</h2>

<br><br>

<h3 align="center"><img src="img/signup.png" style="vertical-align:middle" width="45" height="45" alt="iscriviti">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#94B84D">Recupero credenziali di accesso</font></h3>

<br>

<div class="tools-alert tools-alert-yellow">
Hai già effettuato la registrazione ma non ricordi più le tue credenziali di accesso?
<br>
Puoi riceverle nuovamente via email:
</div>

<br>

<form action="conferma_recupero.php" method="POST" class="forms">
<div class="table-container" align="center">
<table>
<tr>
  <td>scrivi il tuo indirizzo email istituzionale:</td>
  <td class="input-groups"><input type="text" name="email" placeholder="nome.cognome"><span class="input-append">@scuole.provincia.tn.it</span></td>
  <td></td>
 </tr>
 <tr>
  <td>copia queste 4 cifre:</td>
  <td><img src="captcha.php" style="vertical-align:middle"></td>
  <td><input name="captcha" maxlength="4" type="text"></td>
 </tr>
 <tr>
  <td colspan="3" class="text-centered"><input type="submit" name="clicca" value="invia" class="btn btn-round" /></td>
 </tr>
</table>
</div>
</form>

</div>
</div>

</body>
</html>