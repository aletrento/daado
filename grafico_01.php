<?php
session_start();
session_regenerate_id(TRUE);
if (!isset($_SESSION['username'] ) )
{
header('location:index.php');
exit;
}
else
{
include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_bar.php");
$objConnect = mysql_connect("","","") or die;
$objDB = mysql_select_db("my_daado");
$data = date("d-m-y");

$settembre = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_settembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='09'");
$tot_settembre = mysql_fetch_assoc($settembre);
$media_settembre = ($tot_settembre['somma_settembre']/4);
$ottobre = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_ottobre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='10'");
$tot_ottobre = mysql_fetch_assoc($ottobre);
$media_ottobre = ($tot_ottobre['somma_ottobre']/4);
$novembre = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_novembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='11'");
$tot_novembre = mysql_fetch_assoc($novembre);
$media_novembre = ($tot_novembre['somma_novembre']/4);
$dicembre = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_dicembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='12'");
$tot_dicembre = mysql_fetch_assoc($dicembre);
$media_dicembre = ($tot_dicembre['somma_dicembre']/3);
$gennaio = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_gennaio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='01'");
$tot_gennaio = mysql_fetch_assoc($gennaio);
$media_gennaio = ($tot_gennaio['somma_gennaio']/3.5);
$febbraio = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_febbraio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='02'");
$tot_febbraio = mysql_fetch_assoc($febbraio);
$media_febbraio = ($tot_febbraio['somma_febbraio']/4);
$marzo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_marzo FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='03'");
$tot_marzo = mysql_fetch_assoc($marzo);
$media_marzo = ($tot_marzo['somma_marzo']/3.5);
$aprile = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_aprile FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='04'");
$tot_aprile = mysql_fetch_assoc($aprile);
$media_aprile = ($tot_aprile['somma_aprile']/4);
$maggio = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_maggio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='05'");
$tot_maggio = mysql_fetch_assoc($maggio);
$media_maggio = ($tot_maggio['somma_maggio']/4);
$giugno = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_giugno FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='06'");
$tot_giugno = mysql_fetch_assoc($giugno);
$media_giugno = ($tot_giugno['somma_giugno']/1);

$graph = new Graph(580,390);
$graph->SetScale("textint");

$ydata = array($media_settembre,$media_ottobre,$media_novembre,$media_dicembre,$media_gennaio,$media_febbraio,$media_marzo,$media_aprile,$media_maggio,$media_giugno);
$user = $_SESSION['username'];

$graph->SetMargin(50,30,70,70);

$labels = array("set","ott","nov","dic","gen","feb","mar","apr","mag","giu");
$graph->xaxis->SetTickLabels($labels);

$graph->title->Set('MEDIA SETTIMANALE espressa in unità orarie di 60 minuti');
$graph->title->SetColor('#5074ee');
$graph->subtitle->Set("utente: $user (data: $data)");
$graph->yaxis->title->Set('ore settimanali');
$graph->xaxis->title->Set('mesi');

$barplot=new BarPlot($ydata);
$graph->Add($barplot);
$barplot->SetFillGradient("#94b8ff","#d3e7ff",GRAD_HOR);
$barplot->SetColor("#94b8ff");

$graph->Stroke();
mysql_close($objConnect);
}
?>