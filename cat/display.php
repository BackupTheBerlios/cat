<?php

require('config.inc.php');

$db2 = new db_local;

$design->readTemplatesFromFile('display.xml');

//get data
$db->query("SELECT f.id,f.artist,f.title,a.name AS album,f.addedby,f.status,f.type,f.content,f.views,f.date
				FROM catfiles f
				LEFT JOIN catalbums a ON f.album=a.id
				WHERE f.id = $id");

if ($db->next_record())
{

	switch ($type)
	{
		case 'lyrics'   : $type = '1'; break;
		case 'chords'   : $type = '2'; break;
		case 'tabs'     : $type = '3'; break;
		case 'btabs'    : $type = '4'; break;
    }

    switch ($type)
	{
		case '1': $subpagetitle = $lang['display']['viewlyrics']; break;
		case '2': $subpagetitle = $lang['display']['viewchords']; break;
		case '3': $subpagetitle = $lang['display']['viewtab']; break;
		case '4': $subpagetitle = $lang['display']['viewbtab']; break;
    }

	$design->addVar("basic", "PAGETITLE", "$subpagetitle: {$db->record['artist']} - {$db->record['title']}");


	//update page view counter
	$currentviews = $myrow['views']+1;
	$date = $myrow['date'];
	$db2->query("UPDATE catfiles	SET views = '$currentviews', date = '$date' WHERE id = $id");

	//tweak fields
	$db->record['content'] = stripslashes($db->record['content']);

	if ($type != 1)
	{
		$db->record['content'] = str_replace(' ','&nbsp;',$db->record['content']);
	}
	else
	{
		$db->record['content'] = htmlentities($db->record['content']);
	}

	$db->record['content'] = preg_replace("/(\015\012)|(\015)|(\012)/","<br>",$db->record['content']);

	$design->addVar("display", "ARTIST", $db->record['artist']);
	$design->addVar("display", "TITLE", $db->record['title']);
	$design->addVar("display", "ALBUM", $db->record['album']);
	$design->addVar("display", "ARTIST_URL", urlencode($db->record['artist']));
	$design->addVar("display", "ALBUM_URL", urlencode($db->record['album']));
	$design->addVar("display", "ADDEDBY", $db->record['addedby']);


	switch ($type)
	{
		case '1':
		default:
			$design->addVar("display", "CONTENTFONT", '<font color="#FFFFFF">');
		break;

		case '2':
		case '3':
		case '4':
			$design->addVar("display", "CONTENTFONT", '<font color="#FFFFFF" size="2" face="Courier New, Courier, mono">');
		break;
	}

	$design->addVar("display", "CONTENT", $db->record['content']);
	$design->addVar("display", "LANG_ADDEDBY", $lang['added_by']);
	$design->addVar("display", "LANG_DISPLAY_VIEWCOUNTER", sprintf($lang['display']['viewcounter'], $db->record['views']));
	$design->addVar("display", "ID", $db->record['id']);
	$design->addVar("display", "TYPE", $db->record['type']);
	$design->addVar("display", "LANG_DISPLAY_PRINTVERSION", $lang['display']['printversion']);


/* ADMIN STUFF BELOW HERE */
/*		if (isset($HTTP_COOKIE_VARS['user']) && isset($HTTP_COOKIE_VARS['pass'])) {
			$username = $HTTP_COOKIE_VARS['user'];
			$password = $HTTP_COOKIE_VARS['pass'];

			$result = mysql_query("SELECT id FROM catusers
				 WHERE name='$username'
				 AND pass='$password'");

			if ($result) {
				$row = mysql_fetch_array($result);
				$uid = $row['id'];

				$result2 = mysql_query("SELECT user_id FROM catbookmarks WHERE user_id=$uid AND file_id={$myrow['id']}");

				if (mysql_num_rows($result2)<1)
				{
					echo '<a href="/en/addbookmark.php?id='.$id.'">'.$lang['display']['addbookmark'].'</a>';
				}

				$result = mysql_query("SELECT admin_lyr,admin_crd,admin_tab,admin_btab FROM catadmins WHERE userid='$uid'");
		   }

		   if ($result) {
		      if (mysql_num_rows($result)>0) {
			  print '<hr height="1" width="250" align="left">';
			  if ($myrow['status']=='0') {
			     //approve link
			     printf('<a href="%s?mode=approve&id=%s&type=%s"><b>[APPROVE]</b></a> ','/en/admin'.$scriptext,$myrow['id'],$myrow['type']);
			     print ' ';
			  } //end_if myrow...

			  //edit link
			   printf('<a href="%s?mode=edit&id=%s"><b>[EDIT]</b></a> ','/en/admin'.$scriptext,$myrow['id']);

			   //delete link
			   printf('<a href="%s?mode=delete&id=%s"><b>[DELETE]</b></a>','/en/admin'.$scriptext,$myrow['id']);

			   //special links
			   if ($myrow['type']==1 && $myrow['status']==0) {
			     echo '<hr height="1" width="250" align="left">';
			     echo '<p>Automatic Content Correction</p>';
			     echo '<ul>';
			     echo "<li><a href=\"/en/admin.php?mode=special&amp;submode=smart&amp;id=".$myrow['id']."\"><b>[SMART]</b></a></li>";
			     echo "<li><a href=\"/en/admin.php?mode=special&amp;submode=rmslashes&amp;id=".$myrow['id']."\"><b>[RMSLASHES]</b></a></li>";
			     echo "<li><a href=\"/en/admin.php?mode=special&amp;submode=lower&amp;id=".$myrow['id']."\"><b>[LOWER]</b></a></li>";
			     echo "<li><a href=\"/en/admin.php?mode=special&amp;submode=ucfirst&amp;id=".$myrow['id']."\"><b>[UCFIRST]</b></a></li>";
			     echo '</ul>';
			     echo '<hr height="1" width="250" align="left">';
			     echo '<p>Extended Content Correction</p>';
			     echo '<ul>';
			     echo "<li>
				   <b>String Replace (case sensitive)</b><br>
				   <form method=\"GET\" action=\"/en/admin.php\">
				   <input type=\"hidden\" name=\"mode\" value=\"special\">
				   <input type=\"hidden\" name=\"submode\" value=\"stringreplace\">
				   <input type=\"hidden\" name=\"id\" value=\"".$myrow['id']."\">
				   <input style=\"font-family:Courier New,Courier\" type=\"text\" name=\"string1\" maxlength=\"200\" size=\"20\"> &gt;&gt; <input style=\"font-family:Courier New,Courier\" type=\"text\" name=\"string2\" maxlength=\"200\" size=\"20\">
				   <input type=\"submit\" value=\"Replace\">
				   </form>
				   </li>";
			     echo "<li>
				   <b>Regular Expression Replace</b><br>
				   <form method=\"GET\" action=\"/en/admin.php\">
				   <input type=\"hidden\" name=\"mode\" value=\"special\">
				   <input type=\"hidden\" name=\"submode\" value=\"regexreplace\">
				   <input type=\"hidden\" name=\"id\" value=\"".$myrow['id']."\">
				   <input style=\"font-family:Courier New,Courier\" type=\"text\" name=\"pattern\" maxlength=\"200\" size=\"40\"> &gt;&gt; <input style=\"font-family:Courier New,Courier\" type=\"text\" name=\"replace\" maxlength=\"200\" size=\"20\">
				   <input type=\"submit\" value=\"Replace\">
				   </form>
				   </li>";
			     echo '</ul>';
			   }
				      } //end_if mysql_num_rows...
		   } //end if_result...
		} //end_if cookies...*/
	$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate("display"));
}
else
{
	$design->addVar("error", "ERROR", $lang['display']['notfound']);
	$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate("error"));
}

$design->displayParsedTemplate("basic");

?>
