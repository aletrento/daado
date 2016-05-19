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
$path = "./csv/";
$out_file = $path.'tabella_docente_'.$_GET['username'].'_'.date("d-m-Y-h:i").'.csv';
$write_file = fopen($out_file,"w") or die("Qualcosa non funziona... non riesco ad aprire il file.");

fputcsv($write_file, array('UTENTE', 'GIORNO', 'MESE', 'ANNO', 'ORA_INIZIO', 'MIN_INIZIO', 'ORA_FINE', 'MIN_FINE', 'FORFAIT', 'COSA_HA_FATTO', 'CATEGORIA', 'TIPO', 'TAG'));
$link = mysql_connect('', '', '');
mysql_select_db('my_daado');
$utente = $_GET['username'];
$rows = mysql_query("SELECT utente,giorno,mese,anno,ora_ini,min_ini,ora_fine,min_fine,forfait,descrizione,categoria,tipo,tag FROM eventi WHERE utente = '$utente' ORDER BY anno,mese,giorno,ora_ini asc");
while ($row = mysql_fetch_assoc($rows))
{
 fputcsv($write_file, $row);
}
fclose($out_file);
chmod($out_file, 0777);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.basename($out_file).'"');
header('Content-Length: ' . filesize($out_file));
ob_clean();
flush();
readfile($out_file);
exit();
mysql_close($link);
}
?>