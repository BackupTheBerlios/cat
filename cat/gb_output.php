<?php
include_once('db_mysql.inc.php');
include_once('dbconfig.inc.php');
$db = new db_local;

$anzahl = 5;
if ($_REQUEST['page'] == "")
{
	$page = 1;
}
$limit = ($page - 1) * $anzahl;

$db->query("SELECT author, text, UNIX_TIMESTAMP(date) AS datum
			FROM guestbook
			ORDER BY date DESC
			LIMIT $limit,$anzahl");
while ($db->next_record())
{
	echo "<table>";
	echo "<tr><td>";
	echo "User: <span style=\"font-style: italic; font-weight: bold;\">".htmlentities($db->record['author'])."</span>";
	echo "</tr><tr><td>";
	echo "Date: ".date("d.m.Y \u\m H:i", $db->record['datum']);
	echo "</td></tr><tr><td>";
	echo nl2br(htmlentities($db->record['text']));
	echo "</td></tr>";
	echo "</table>";
	echo "<hr>";
}

echo '<form action="gb_input.php"><input type="submit" value="Hab auch was zu sagen"></form><br>';

if ($page != 1)
{
	echo '<a href="gb_output.php?page='.($page-1).'">Back</a>&nbsp;';
}

$db->query('SELECT count(*) FROM guestbook');
$rows = $db->result();

if ($rows - ($page * $anzahl + $anzahl - ($rows % $anzahl)) >= 0 )
{
echo '<a href="gb_output.php?page='.($page+1).'">Forward</a><br>';
}
echo "\$limit: ".$limit."<br>";
echo "\$rows: ".$rows."<br>";
echo "\$page * \$anzahl: ".($page*$anzahl)."<br>";
echo (3%5);
?>
