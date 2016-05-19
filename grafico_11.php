<?php
include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_bar.php");
$objConnect = mysql_connect("","","") or die;
$objDB = mysql_select_db("my_daado");
$giorno = date("d-m-y");

$uno = "SELECT * FROM eventi WHERE ora_ini = '07' AND ora_fine >= '07' AND ora_fine <= '09' AND min_fine <= '59'";
$q_uno = mysql_query($uno);
$n_uno = mysql_num_rows($q_uno);

$due = "SELECT * FROM eventi WHERE ora_ini = '08' AND ora_fine >= '08' AND ora_fine <= '10' AND min_fine <= '59'";
$q_due = mysql_query($due);
$n_due = mysql_num_rows($q_due);

$tre = "SELECT * FROM eventi WHERE ora_ini = '09' AND ora_fine >= '09' AND ora_fine <= '11' AND min_fine <= '59'";
$q_tre = mysql_query($tre);
$n_tre = mysql_num_rows($q_tre);

$quattro = "SELECT * FROM eventi WHERE ora_ini = '10' AND ora_fine >= '10' AND ora_fine <= '12' AND min_fine <= '59'";
$q_quattro = mysql_query($quattro);
$n_quattro = mysql_num_rows($q_quattro);

$cinque = "SELECT * FROM eventi WHERE ora_ini = '11' AND ora_fine >= '11' AND ora_fine <= '13' AND min_fine <= '59'";
$q_cinque = mysql_query($cinque);
$n_cinque = mysql_num_rows($q_cinque);

$sei = "SELECT * FROM eventi WHERE ora_ini = '12' AND ora_fine >= '12' AND ora_fine <= '14' AND min_fine <= '59'";
$q_sei = mysql_query($sei);
$n_sei = mysql_num_rows($q_sei);

$sette = "SELECT * FROM eventi WHERE ora_ini = '13' AND ora_fine >= '13' AND ora_fine <= '15' AND min_fine <= '59'";
$q_sette = mysql_query($sette);
$n_sette = mysql_num_rows($q_sette);

$otto = "SELECT * FROM eventi WHERE ora_ini = '14' AND ora_fine >= '14' AND ora_fine <= '16' AND min_fine <= '59'";
$q_otto = mysql_query($otto);
$n_otto = mysql_num_rows($q_otto);

$nove = "SELECT * FROM eventi WHERE ora_ini = '15' AND ora_fine >= '15' AND ora_fine <= '17' AND min_fine <= '59'";
$q_nove = mysql_query($nove);
$n_nove = mysql_num_rows($q_nove);

$dieci = "SELECT * FROM eventi WHERE ora_ini = '16' AND ora_fine >= '16' AND ora_fine <= '18' AND min_fine <= '59'";
$q_dieci = mysql_query($dieci);
$n_dieci = mysql_num_rows($q_dieci);

$undici = "SELECT * FROM eventi WHERE ora_ini = '17' AND ora_fine >= '17' AND ora_fine <= '19' AND min_fine <= '59'";
$q_undici = mysql_query($undici);
$n_undici = mysql_num_rows($q_undici);

$dodici = "SELECT * FROM eventi WHERE ora_ini = '18' AND ora_fine >= '18' AND ora_fine <= '20' AND min_fine <= '59'";
$q_dodici = mysql_query($dodici);
$n_dodici = mysql_num_rows($q_dodici);

$tredici = "SELECT * FROM eventi WHERE ora_ini = '19' AND ora_fine >= '19' AND ora_fine <= '21' AND min_fine <= '59'";
$q_tredici = mysql_query($tredici);
$n_tredici = mysql_num_rows($q_tredici);

$quattordici = "SELECT * FROM eventi WHERE ora_ini = '20' AND ora_fine >= '20' AND ora_fine <= '22' AND min_fine <= '59'";
$q_quattordici = mysql_query($quattordici);
$n_quattordici = mysql_num_rows($q_quattordici);

$quindici = "SELECT * FROM eventi WHERE ora_ini = '21' AND ora_fine >= '21' AND ora_fine <= '23' AND min_fine <= '59'";
$q_quindici = mysql_query($quindici);
$n_quindici = mysql_num_rows($q_quindici);

$graph = new Graph(580,390);
$graph->SetScale("textint");

$ydata = array($n_uno,$n_due,$n_tre,$n_quattro,$n_cinque,$n_sei,$n_sette,$n_otto,$n_nove,$n_dieci,$n_undici,$n_dodici,$n_tredici,$n_quattordici,$n_quindici);

$graph->SetMargin(50,30,70,70);

$labels = array("7-10",
		"8-11",
		"9-12",
		"10-13",
		"11-14",
		"12-15",
		"13-16",
		"14-17",
		"15-18",
		"16-19",
		"17-20",
		"18-21",
		"19-22",
		"20-23",
		"21-24");
$graph->xaxis->SetTickLabels($labels);

$graph->title->Set('Distribuzione delle attività durante il giorno');
$graph->title->SetColor('#D9C3DD');
$graph->subtitle->Set("calcolata su tutti gli utenti (data: $giorno)");
$graph->yaxis->title->Set('totale attività registrate');
$graph->xaxis->title->Set('fasce orarie');

$barplot=new BarPlot($ydata);
//$barplot->value->Show();
$barplot->SetWidth(0.7);
$graph->Add($barplot);
$barplot->SetFillGradient("#EEDDFF","#EAD4FF",GRAD_HOR);
$barplot->SetColor("#EEDDFF");
//$barplot->value->Show();
//$barplot->value->SetFormat('%d');
//$barplot->SetValuePos('center');
$graph->Stroke();
mysql_close($objConnect);
?>
