<?php
include_once('db_mysql.inc.php');
include_once('dbconfig.inc.php');
$db = new db_local;

$anzahl = 5;
if ($_REQUEST['page'] == "")
{
	$page = 1;
}
else
$page = $_REQUEST['page'];
$limit = ($page - 1) * $anzahl;

$db->query("SELECT user_id, user_name, user_text
			FROM songfiles
			ORDER BY user_id DESC
			LIMIT $limit,$anzahl"); //UNIX_TIMESTAMP(date) AS datum
while ($db->next_record())
{
	echo "<table>";
	echo "<tr><td>";
	echo "User: <span style=\"font-style: italic; font-weight: bold;\">".htmlentities($db->record['user_name'])."</span>";
	echo "</tr><tr><td>";
	//echo "Date: ".date("d.m.Y \u\m H:i", $db->record['datum']);
	echo "</td></tr><tr><td>";
	echo "id: ".$db->record['user_id']."....".nl2br(htmlentities($db->record['user_text']));
	echo "</td></tr>";
	echo "</table>";
	echo "<hr>";
}

echo '<form action="cat_gb_input.php"><input type="submit" value="Hab auch was zu sagen"></form><br>';

if ($page != 1)
{
	echo '<a href="cat_gb_output.php?page='.($page-1).'">Back</a>&nbsp;';
}

$db->query('SELECT count(*) FROM songfiles');
$rows = $db->result();

$sites = ceil($rows / $anzahl);
if ($page < $anzahl)
{
  if ($sites > $anzahl)
  {
    $sites = $anzahl;
  }
for ($x = 0; $x < $sites; $x++)
{
 echo '<a href="cat_gb_output.php?page='.($x+1).'">'.($x+1).'</a> &nbsp;';
}
}

$stop = ($page + 1);
$start = ($page - ceil($anzahl / 2));
if ($page >= $anzahl)
{
  if (($page + 1) > $sites)
  {
   $stop = $sites;
  }
  if ($page < $anzahl && $page != 1)
  {
    $start = ($page - 1);
  }
  for ($y = $start; $y <= $stop; $y++)
  {
   echo '<a href="cat_gb_output.php?page='.$y.'">'.$y.'</a> &nbsp;';
  }
}

//if ($rows - ($page * $anzahl + $anzahl - ($rows % $anzahl)) >= 0 )

if ( ($rows - ($page  * $anzahl))  > 0 || ($rows - $page) < 0 )
{
echo '<a href="cat_gb_output.php?page='.($page+1).'">Forward</a>';
}
/*echo "<br>";
echo "\$limit: ".$limit."<br>";
echo "\$rows: ".$rows."<br>";
echo "\$page * \$anzahl: ".($page*$anzahl)."<br>";
echo "\$page: ".$page." <br>";
echo "\$anzahl: {$anzahl} <br>";
echo "Ergebnis: ".($rows - $page  * $anzahl)."<br>";
echo "Modolo: ". ($rows%($page * $anzahl))."<br>";
echo "rows - page : ". ($rows - $page)."<br>";*/
echo "<br> \$rows : \$anzahl = ".($rows / $anzahl)." <br>";
echo "\$rows : {$rows} <br>";
echo "Das ist Seite {$page}<br>";
?>
