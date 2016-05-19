<!DOCTYPE html>
<html>
<head>
<title>DAADO</title>
 
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="keywords" content="docenti, scuola secondaria, Trentino, ore, database, articoli, recupero">
<meta name="description" content="sito per la registrazione delle attività aggiuntive svolte a scuola">
<meta name="author" content="Alessandro Vallin">

<link rel="stylesheet" href="css/kube.min.css" />
<link rel="stylesheet" href="css/stile.css" />
<link rel="stylesheet" href="css/animate.css" />
<link rel="icon" href="img/clip.ico" />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
<script src="js/kube.min.js"></script>
<script>
if (navigator.appName == "Microsoft Internet Explorer"){
alert('Stai usando Internet Explorer.\nDAADO si vede meglio con altri browser\n(ad es. Firefox, Chrome o Safari)');
}
</script>
<style type="text/css">
img {
  -webkit-animation-delay: 4s;
  -moz-animation-delay: 4s;
  -ms-animation-delay: 4s;
  vertical-align: middle;
}
h1 {
  -webkit-animation-delay: 2s;
  -moz-animation-delay: 2s;
  -ms-animation-delay: 2s;
}
</style>
</head>
<body>

<nav class="navbar navbar-pills">
 <ul>
  <li><a href="intro.php"><img src="img/what.png" width="35" height="35" alt="intro"></a></li>
  <li><a href="registrazione.php"><img src="img/signup.png" width="35" height="35" alt="iscriviti"></a></li>
  <li><a href="info.php"><img src="img/pie.png" width="35" height="35" alt="numeri"></a></li>
  <li><a href="files.php"><img src="img/share.png" width="35" height="35" alt="condividi"></a></li>
 </ul>
</nav>

<div class="units-row">
<div class="unit-centered unit-80">

<div class="text-right">
 <figure>
  <img src="img/dado.gif" width="100" height="100" alt="logo" />
 </figure>
</div>

 <h1 align="center" class="animated bounce"><font color="#B8A08A">D</font>.<font color="#FFB870">A</font>.<font color="#9ABA88">A</font>.<font color="#ADC2FF">DO</font>.</h1>
 <h2 align="center"><font color="#B8A08A">D</font>atabase delle <font color="#FFB870">A</font>ttività <font color="#9ABA88">A</font>ggiuntive dei <font color="#ADC2FF">DO</font>centi</h2>

<br>

<div>
<h3 align="left"><img src="img/signin.png" style="vertical-align:middle" width="38" height="38" alt="accedi" class="animated bounce">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#7094FF">Accesso</font></h3>
</div>

<div class="units-row">
 <div class="unit-30"></div>
 <div class="unit-70">
  <form class="forms" action="verifica.php" method="POST">
   <table class="table-simple">
    <tbody>
     <tr>
      <td><strong>username</strong>:</td>
      <td><input type="text" name="username"></td>
     </tr>
     <tr>
      <td><strong>password</strong>:</td>
      <td><input type="password" name="password"></td>
     </tr>
      <td colspan="2" class="text-centered"><input type="submit" class="btn btn-outline" name="clicca" value="entra"></td>
    </tbody>
   </table>
  </form>
</div>
</div>

<ul class="blocks-3">
 <li>
  <div class="tools-alert tools-alert-yellow" align="center">
   <small>Hai dimenticato la tua password?</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="recupero.php"><img src="img/forgot.png" style="vertical-align:middle" width="35" height="35" alt="recupero credenziali"></a>
  </div>
 </li>
 <li></li>
 <li>
  <div class="tools-alert" align="center">
  <small>2014-2016 - Alessandro Vallin</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="files.php"><img src="img/info.png" width="35" height="35" style="vertical-align:middle" alt="info"></a>
  </div>
 </li>
</ul>

</div>
</div>

</body>
</html>