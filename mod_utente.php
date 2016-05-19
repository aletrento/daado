<!DOCTYPE html>
<html>
<head>
<title>aggiornamento utente</title>
 
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

 <h3 align="center">Modifica dati utente<img src="img/update.gif" width="29" height="20" title="modifica" align="center"></h3>

<br><br>

<div align="right" class="tools-alert tools-alert-blue">
Torna alla <a href="db_utenti.php">tabella UTENTI</a>.
</div>

<br><br>
<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = "SELECT * FROM utenti WHERE id = '".$_GET["id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Impossibile caricare i dati.".$_GET["id"];
}
else
{
?>

<form action="salva_utente.php?id=<?=$_GET["id"];?>" name="edit" method="POST" class="forms">
<div class="table-container" align="center">
 <table class="table-hovered">
  <tr>
   <th class="text-centered highlight">titolo</th>
   <th class="text-centered highlight">nome</th>
   <th class="text-centered highlight">cognome</th>
   <th class="text-centered highlight">scuola</th>
   <th class="text-centered highlight">materia</th>
   <th class="text-centered highlight">anno</th>
   <th class="text-centered highlight">username</th>
   <th class="text-centered highlight">password</th>
   <th class="text-centered highlight">email</th>
   <th class="text-centered highlight">active</th>
   <th class="text-centered highlight">accesso</th>
  </tr>
  <tr>
   <td><input type="number" name="titolo" maxlength="8" value="<?=$objResult["titolo"];?>"></td>
   <td><input type="number" name="nome" maxlength="25" value="<?=$objResult["nome"];?>"></td>
   <td><input type="number" name="cognome" maxlength="25" value="<?=$objResult["cognome"];?>"></td>
   <td><input type="number" name="scuola" maxlength="55" value="<?=$objResult["scuola"];?>"></td>
   <td><input type="number" name="materia" maxlength="30" value="<?=$objResult["materia"];?>"></td>
   <td><input type="number" name="anno" maxlength="7" value="<?=$objResult["anno"];?>"></td>
   <td><input type="number" name="username" maxlength="25" value="<?=$objResult["username"];?>"></td>
   <td><input type="text" name="password" maxlength="25" value="<?=$objResult["password"];?>"></td>
   <td><input type="text" name="email" maxlength="60" value="<?=$objResult["email"];?>"></td>
   <td><input type="text" name="active" maxlength="1" value="<?=$objResult["active"];?>"></td>
   <td><input type="number" name="accesso" maxlength="25" value="<?=$objResult["accesso"];?>"></td>
  </tr>
 </table>
</div>

<div align="right">
<input type="submit" name="submit" value="aggiorna" class="btn btn-round">
</div>
</form>

<?
}
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>