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
include ("jpgraph/src/jpgraph_pie.php");

$objConnect = mysql_connect("","","") or die;
$objDB = mysql_select_db("my_daado");
$giorno = date("d-m-y");
$qfondo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS fondo FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='fondo'");
$tot_fondo = mysql_fetch_assoc($qfondo);
$totale = number_format(($tot_fondo['fondo']), 1);

$qlezioni = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS lezioni FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='fondo' AND (tag='07' OR tag='08' OR tag='09')");
$tot_lezioni = mysql_fetch_assoc($qlezioni);
$lezioni = ($tot_lezioni['lezioni']/$totale);

$qviaggi = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS viaggi FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='fondo' AND (tag='10' OR tag='24')");
$tot_viaggi = mysql_fetch_assoc($qviaggi);
$viaggi = ($tot_viaggi['viaggi']/$totale);

$qcoo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS coo FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='fondo' AND (tag='16' OR tag='17')");
$tot_coo = mysql_fetch_assoc($qcoo);
$coo = ($tot_coo['coo']/$totale);

$qrespo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS respo FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='fondo' AND (tag='19' OR tag='20' OR tag='21')");
$tot_respo = mysql_fetch_assoc($qrespo);
$respo = ($tot_respo['respo']/$totale);

$qaltro = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS altro FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='fondo' AND (tag='01' OR tag='02' OR tag='03' OR tag='04' OR tag='05' OR tag='06' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='18' OR tag='22' OR tag='23')");
$tot_altro = mysql_fetch_assoc($qaltro);
$altro = ($tot_altro['altro']/$totale);

$data = array($lezioni,$viaggi,$coo,$respo,$altro);
$user = $_SESSION['username'];
$labels = array("tag 7, 8 e 9\n(%.1f%%)",
				"tag 10 e 24\n(%.1f%%)",
				"tag 16 e 17\n(%.1f%%)",
				"tag 19, 20 e 21\n(%.1f%%)",
				"altri tag\n(%.1f%%)");

$graph = new PieGraph(500,480,auto);
$graph->SetShadow();

$graph->title->Set("Distribuzione del F.U.I.S.");
$graph->title->SetColor('#5074ee');
$graph->subtitle->Set("percentuale calcolata su utente: $user (data: $giorno)");
$graph->footer->center->Set("calcolata sulle attività caricate sul FUIS\n(= $totale ore)");
$graph->footer->center->SetColor('#5074ee');

$p1 = new PiePlot($data);
$p1->SetTheme("sand");
$p1->SetCenter(0.5,0.5);
$p1->SetSize(0.3);
$p1->SetLabels($labels);
$p1->SetLabelPos(1);

$p1->SetGuideLines();
$p1->SetGuideLinesAdjust(1.4);

$p1->SetLabelType(PIE_VALUE_PER);
$p1->value->Show();
$p1->value->SetColor('darkgray');

$graph->Add($p1);
$graph->Stroke();
mysql_close($objConnect);
}
?>