<?php

$anzahl = 1;
$show = 5;


$page = ($_REQUEST['page'] != "" ? $_REQUEST['page'] : 1) ;

$limit = ($page - 1) * $anzahl;

$db->query("SELECT id, author, text
			FROM guestbook
			ORDER BY id DESC
			LIMIT $limit,$anzahl"); //UNIX_TIMESTAMP(date) AS datum
while ($db->next_record())
{
	echo "<table>";
	echo "<tr><td>";
	echo "User: <span style=\"font-style: italic; font-weight: bold;\">".htmlentities($db->record['author'])."</span>";
	echo "</tr><tr><td>";
	//echo "Date: ".date("d.m.Y \u\m H:i", $db->record['datum']);
	echo "</td></tr><tr><td>";
	echo "id: ".$db->record['id']."....".nl2br(htmlentities($db->record['text']));
	echo "</td></tr>";
	echo "</table>";
	echo "<hr>";
}

echo '<form action="cat_gb_input.php"><input type="submit" value="Hab auch was zu sagen"></form><br>';

if ($page != 1)
{
	echo '<a href="cat_gb_output_test.php?page='.($page-1).'">Back</a>&nbsp;';
}

$db->query('SELECT count(*) FROM guestbook');
$rows = $db->result();

$sites = ceil($rows / $anzahl);

if ($sites < $show)
{
 for ($x = 0; $x < $sites; $x++)
 {
  echo '<a href="cat_gb_output_test.php?page='.($x+1).'">'.($x+1).'</a> &nbsp;';
 }
}

$stop = ($page + 2);
$start = ($page - 3);

if ($sites > $show)
{
	if ($stop > $sites)
	{
		$stop = $sites;
		$start = ($page - 4);
	}


	switch ($page)
	{
		case $sites:
			$start = ($page - 5);
		break;

		case >= 3:
			for ( $z = $start; $z < $stop; $z++)
			{
			echo '<a href="cat_gb_output_test.php?page='.($z + 1).'">'.($z + 1).'</a> &nbsp;';
			}
		break;

		case < 3:
			for ($y = 0; $y < $show; $y++)
			{
			echo '<a href="cat_gb_output_test.php?page='.($y + 1).'">'.($y + 1).'</a> &nbsp;';
			}
		break;

		default:
	}

/*	if ($page == $sites)
	{
		$start = ($page - 5);
	}

	if ($page >= 3)
	{
	  for ( $z = $start; $z < $stop; $z++)
	  {
		echo '<a href="cat_gb_output_test.php?page='.($z + 1).'">'.($z + 1).'</a> &nbsp;';
	  }
	}

	if ($page <  3)
	{
	  for ($y = 0; $y < $show; $y++)
	  {
	   echo '<a href="cat_gb_output_test.php?page='.($y + 1).'">'.($y + 1).'</a> &nbsp;';
	  }
	}*/

}



//if ($rows - ($page * $anzahl + $anzahl - ($rows % $anzahl)) >= 0 )

if ( ($rows - ($page  * $anzahl))  > 0 || ($rows - $page) < 0 )
{
echo '<a href="cat_gb_output_test.php?page='.($page+1).'">Forward</a>';
}





/*echo "<br>";
echo "\$limit: ".$limit."<br>";
echo "\$rows: ".$rows."<br>";
echo "\$page * \$anzahl: ".($page*$anzahl)."<br>";
echo "\$page: ".$page." <br>";
echo "\$anzahl: {$anzahl} <br>";
echo "Ergebnis: ".($rows - $page  * $anzahl)."<br>";
echo "Modulo: ". ($rows%($page * $anzahl))."<br>";
echo "rows - page : ". ($rows - $page)."<br>";*/
echo "<br> \$rows : \$anzahl = ".($rows / $anzahl)." <br>";
echo "\$rows : {$rows} <br>";
echo "Das ist Seite {$page}<br>";
echo "Start bei : ".($page - 3)."<br>";
?>
