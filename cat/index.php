<?php

	#error_reporting(E_ALL);

	include('config.inc.php');
	$design->readTemplatesFromFile("index.xml");
	$design->addVar("basic", "PAGETITLE", 'Entrance');

/*$sql = 'SELECT author,headline,date,content FROM catnews ORDER BY date DESC LIMIT 0,20';
$result = mysql_query($sql);
if (!$result) {
    include('dberror.php');
} else {
    while ($row = mysql_fetch_array($result)) {
	//format date

	$filedate=substr($row['date'],0,4).'-'
		 .substr($row['date'],4,2).'-'
		 .substr($row['date'],6,2)
		 .' '.substr($row['date'],8,2).':'
		 .substr($row['date'],10,2);

	echo '<p align="center"><b><i>'.$row['headline'].' -</i></b> <font size="2"><i>by '.$row['author'].' @ '.$filedate.'</i></font></p>';
	echo '<p align="center"><font size="2">'.$row['content'].'<br></font></p>';
	echo '<hr size="1" width="90%">';
    } //while
}*/

	$design->addVar("index", "NEWS", "Hier stehen dann mal die News.");

	$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate("index"));

	$design->displayParsedTemplate("basic");

?>
