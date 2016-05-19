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

$qtotale = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS totale FROM eventi WHERE utente='{$_SESSION['username']}'");
$tot = mysql_fetch_assoc($qtotale);
$totale = $tot['totale'];
$data = date("d-m-y");

$tag01 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag01 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='01'");
$tot_tag01 = mysql_fetch_assoc($tag01);
$per_tag01 = ((($tot_tag01['tag01'])/$totale)*100);

$tag02 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag02 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='02'");
$tot_tag02 = mysql_fetch_assoc($tag02);
$per_tag02 = ((($tot_tag02['tag02'])/$totale)*100);

$tag03 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag03 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='03'");
$tot_tag03 = mysql_fetch_assoc($tag03);
$per_tag03 = ((($tot_tag03['tag03'])/$totale)*100);

$tag04 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag04 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='04'");
$tot_tag04 = mysql_fetch_assoc($tag04);
$per_tag04 = ((($tot_tag04['tag04'])/$totale)*100);

$tag05 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag05 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='05'");
$tot_tag05 = mysql_fetch_assoc($tag05);
$per_tag05 = ((($tot_tag05['tag05'])/$totale)*100);

$tag06 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag06 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='06'");
$tot_tag06 = mysql_fetch_assoc($tag06);
$per_tag06 = ((($tot_tag06['tag06'])/$totale)*100);

$tag07 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag07 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='07'");
$tot_tag07 = mysql_fetch_assoc($tag07);
$per_tag07 = ((($tot_tag07['tag07'])/$totale)*100);

$tag08 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag08 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='08'");
$tot_tag08 = mysql_fetch_assoc($tag08);
$per_tag08 = ((($tot_tag08['tag08'])/$totale)*100);

$tag09 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag09 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='09'");
$tot_tag09 = mysql_fetch_assoc($tag09);
$per_tag09 = ((($tot_tag09['tag09'])/$totale)*100);

$tag10 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag10 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='10'");
$tot_tag10 = mysql_fetch_assoc($tag10);
$per_tag10 = ((($tot_tag10['tag10'])/$totale)*100);

$tag11 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag11 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='11'");
$tot_tag11 = mysql_fetch_assoc($tag11);
$per_tag11 = ((($tot_tag11['tag11'])/$totale)*100);

$tag12 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag12 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='12'");
$tot_tag12 = mysql_fetch_assoc($tag12);
$per_tag12 = ((($tot_tag12['tag12'])/$totale)*100);

$tag13 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag13 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='13'");
$tot_tag13 = mysql_fetch_assoc($tag13);
$per_tag13 = ((($tot_tag13['tag13'])/$totale)*100);

$tag14 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS tag14 FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='14'");
$tot_tag14 = mysql_fetch_assoc($tag14);
$per_tag14 = ((($tot_tag14['tag14'])/$totale)*100);

$graph = new Graph(580,390);
$graph->SetScale("textint");

$ydata = array($per_tag01,$per_tag02,$per_tag03,$per_tag04,$per_tag05,$per_tag06,$per_tag07,$per_tag08,$per_tag09,$per_tag10,$per_tag11,$per_tag12,$per_tag13,$per_tag14);
$user = $_SESSION['username'];

$graph->SetMargin(50,30,70,70);

$labels = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14");
$graph->xaxis->SetTickLabels($labels);

$graph->title->Set('Percentuale di ciascun tag (eccetto le attività forfetarie) rispetto al totale');
$graph->title->SetColor('#5074ee');
$graph->subtitle->Set("utente: $user (data: $data)");
$graph->yaxis->title->Set('percentuale (%)');
$graph->xaxis->title->Set('# tag (vedi legenda sotto)');

$barplot=new BarPlot($ydata);
$graph->Add($barplot);
$barplot->SetFillGradient("#698b69","#9bcd9b",GRAD_HOR);
$barplot->SetColor("#698b69");
$graph->Stroke();
mysql_close($objConnect);
}
?>
