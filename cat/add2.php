<?php

	require_once('config.inc.php');

	$pagetitle = "{$lang['add2']['pagetitle']} ({$_REQUEST['artist']} - {$_REQUEST['$title']})";

	include('usersonline.inc.php');
	$design->addVar("basic", "USERSONLINE", substr($uo,0,strlen($uo)-2));

	$design->readTemplatesFromFile("add2.xml");
	$design->addVar("basic", "PAGETITLE", $pagetitle);


	$artist   = $_POST['artist'];
	$title    = $_POST['title'];
	$album   = $_POST['album'];
	$addedby = $_POST['addedby'];
	$content	= $_POST['content'];
	$type	= $_POST['type'];

	//convert any number of whitespaces to one single whitespace
	//and remove whitespaces at beginning and end
	$artist  = preg_replace ('/ +/', ' ', $artist);
	$title	 = preg_replace ('/ +/', ' ', $title);
	$album	 = preg_replace ('/ +/', ' ', $album);
	if ($type=='1') $content = preg_replace('/ +/', ' ', $content);

	$artist = trim($artist);
	$title = trim($title);
	$album = trim($album);
	if ($type == '1') $content = trim($content);

	//validate fields
	if (!isset($content) || !trim($content))
	{
		$design->addVar("add2", "PAGETITLE", $lang['add2']['nocontent'].'<br>'.$lang['backbutton']);
		$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate(""));
		$design->displayParsedTemplate("basic");
		exit;
	}

	if (!isset($artist)  || !$artist)  $artist = '(unknown)';
	if (!isset($title)   || !$title)   $title = '(unknown)';
	if (!isset($album)  || !$album)   $album = '(unknown)';
	if (!isset($addedby)|| !$addedby) $addedby = '(unknown)';

	//convert some things
	$content = preg_replace("/’|´|`|``|´´/","'", $content);
	$content = preg_replace("/(\.\.\.)\.+/","...", $content);
	$content = preg_replace("/([ \n])i([ '´`])/","$1I$2", $content);
	$content = preg_replace("/(\015\012)|(015)/","\012", $content);

	//prepare data
	//single quotes not marked as a special character produce a mySQL error
	//if magic_quotes_gpc is not enabled
	$artist = addslashes(stripslashes($artist));
	$title = addslashes(stripslashes($title));
	$album = addslashes(stripslashes($album));
	$addedby = addslashes(stripslashes($addedby));
	$content = addslashes(stripslashes($content));

	//ucfirst() every word of Artist, Title and Album excluding 'of'
	$artist = explode(' ',$artist);
	for ($i=0;$i<sizeof($artist);$i++) if ($artist[$i]!='of') $artist[$i] = ucfirst($artist[$i]);
	$artist = implode(' ',$artist);

	$title = explode(' ',$title);
	for ($i=0;$i<sizeof($title);$i++) if ($title[$i]!='of') $title[$i] = ucfirst($title[$i]);
	$title = implode(' ',$title);

	$album = explode(' ',$album);
	for ($i=0;$i<sizeof($album);$i++) if ($album[$i]!='of') $album[$i] = ucfirst($album[$i]);
	$album = implode(' ',$album);

	//check for typos in album name so we don't insert a new album by mistake
	if ($_POST['usefromdb'])
	{
		$album = $album_db;
	}


	if (!isset($_POST['confirmed']) || $_POST['confirmed'] != 1)
	{
		$firstletter = substr($album,0,1);
		$db->query("SELECT id, name FROM catalbums WHERE name LIKE '$firstletter%'");
		$db2 = new db_local;
		while ($db->next_record())
		{
			$db2->query("SELECT artist FROM catfiles WHERE album='".$db->record['id']."'");
			$distance = levenshtein($album, $db->record['name']);
			if ($distance > 0 && $distance < 4 && $db2->result() == $artist)
			{

				printf("<form action=\"$PHP_SELF\" method=\"POST\">
					<p align=\"center\">".$lang['add2']['spellcheckerinfo']."</p>
					<p align=\"center\"><b>".$db->record['name']."</b><br>
					<input type=\"submit\" name=\"usefromdb\" value=\"".$lang['add2']['usethisalbum']."\">
					</p>",$artist);

				echo '<p align="center">
					<input type="hidden" name="artist" value="'.htmlentities($artist).'">
					<input type="hidden" name="title" value="'.htmlentities($title).'">
					<input type="text" name="album" size="'.(strlen($album)+5).'" maxlength="60" value="'.htmlentities($album).'">
					<input type="hidden" name="album_db" value="'.htmlentities($db->record['name']).'">
					<input type="hidden" name="content" value="'.htmlentities($content).'">
					<input type="hidden" name="addedby" value="'.htmlentities($addedby).'">
					<input type="hidden" name="confirmed" value="1"><br>
					<input type="submit" name="usefromuser" value="'.$lang['add2']['confirmnewalbum'].'">
					</p>
					</form>
				';

				$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate(""));
				$design->displayParsedTemplate("basic");
				exit;
			}
		} //while
	} //if not confirmed

	//strip out HTML tags
	$content = strip_tags($content);

	//update num_submitted
	$db->query("SELECT num_submitted FROM catusers WHERE name = '$addedby'");
	$db->next_record();

	$number = $db->record['num_submitted'] + 1;

	$db->query("UPDATE catusers
				SET num_submitted = '$number'
				WHERE name = '$addedby'");

	//insert album
	$db->query("SELECT id FROM catalbums WHERE name = '$album'");
	if ($db->num_rows() > 0)
	{
		$albumid = $db->result();
	}
	else
	{
		$db->query("INSERT INTO catalbums SET name = '$album'");
		$albumid = $db->insert_id();
	}


	//insert data
	$db->query("INSERT INTO catfiles
				   SET date = NOW(),
				   type = '$type',
				   artist = '$artist',
				   title = '$title',
				   album = '$albumid',
				   addedby = '$addedby',
				   content = '$content'
				  ");

	$db->query("SELECT id,type FROM catfiles
		WHERE artist = '$artist' AND content = '$content'
		ORDER BY date DESC
		LIMIT 0,1");

	$db->next_record();

	echo '<div align="center">';
	echo "<font size=\"4\"><b>".$lang['add2']['success'];
	printf($lang['add2']['num_submit'],$number);
	echo '</b></font><br><hr size="1"><br>';
	echo "<font size=\"4\"><b><a href=\"display.php?id=".$db->record['id']."&amp;type=".$db->record['type']."\">".$lang['add2']['viewaddedfile']."</a></b></font><br><br>";
	echo "<font size=\"4\"><b><a href=\"add.php\">".$lang['add2']['submitanother']."</a></b></font><br>";


	$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate(""));
	$design->displayParsedTemplate("basic");

?>
