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
$qfrontali = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)) AS frontali FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='04' OR tag='07' OR tag='08' OR tag='09' OR tag='10'");
$tot_frontali = mysql_fetch_assoc($qfrontali);
$totale = number_format(($tot_frontali['frontali']), 1);

$qsosti = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)) AS sosti FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='04'");
$tot_sosti = mysql_fetch_assoc($qsosti);
$sosti = ($tot_sosti['sosti']/$totale);

$qrec = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)) AS rec FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='07'");
$tot_rec = mysql_fetch_assoc($qrec);
$rec = ($tot_rec['rec']/$totale);

$qsport = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)) AS sport FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='08'");
$tot_sport = mysql_fetch_assoc($qsport);
$sport = ($tot_sport['sport']/$totale);

$qextra = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)) AS extra FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='09'");
$tot_extra = mysql_fetch_assoc($qextra);
$extra = ($tot_extra['extra']/$totale);

$qitine = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)) AS itine FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='10'");
$tot_itine = mysql_fetch_assoc($qitine);
$itine = ($tot_itine['itine']/$totale);

$data = array($sosti,$rec,$sport,$extra,$itine);
$user = $_SESSION['username'];

$labels = array("sostituzioni\n(%.1f%%)",
				"corsi recupero\ned esami idoneità\n(%.1f%%)",
				"sportelli\ndidattici\n(%.1f%%)",
				"corsi\nextracurricolari\n(%.1f%%)",
				"lezioni\nitineranti\n%.1f%%");

$graph = new PieGraph(500,480,auto);
$graph->SetShadow();

$graph->title->Set("Distribuzione delle ATTIVITA' FRONTALI");
$graph->title->SetColor('#5074ee');
$graph->subtitle->Set("utente: $user (data: $giorno)");
$graph->footer->center->Set("calcolata sul totale relativo ai tag 4, 7, 8, 9 e 10\n(= $totale ore)");
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