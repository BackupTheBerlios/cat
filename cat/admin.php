<?php ob_start();
require('../config.inc.php');

//read configuration
require('../functions.inc'.$scriptext);

if ($mode=='edit') {
?>
<html>
<head>
<title>Cat Admin - File Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body link="#0000FF" vlink="#0000FF">
<?
    $result = mysql_query("SELECT f.id,f.artist,f.title,f.album,f.content,f.addedby,f.status,f.type
			  FROM catfiles f WHERE f.id='$id'
			  ");

    if(!$result) {
	print 'There was a database error - please try again (setstatus'.$scriptext.', mode is $mode).';
	exit;
    } else {
	print '<div align="center">You can view and edit the file below.</div><hr size=1>';
    }

    $myrow = mysql_fetch_array($result);

    $type2 = cat_settype($myrow['type']);

    print '<form name="form2" method="post" action="admin'.$scriptext.'">
		<table width="76%" border="0" cellspacing="2" cellpadding="2">
		    <tr>
		      <td width="17%">
			<div align="right"><i>Artist</i></div>
		      </td>
		      <td width="56%">
			<input type="text" name="artist" size="60" maxlength="60" value="'.stripslashes($myrow['artist']).'">
		      </td>
		    </tr>
		    <tr>
		      <td width="17%">
			<div align="right"><i>Title</i></div>
		      </td>
		      <td width="56%">
			<input type="text" name="title" size="60" maxlength="60" value="'.stripslashes($myrow['title']).'">
		      </td>
		    </tr>
		    <tr>
		      <td width="17%">
			<div align="right"><i>Album</i></div>
		      </td>
		      <td width="56%">
			<select name="album" size="1">
			';

		    $sql = "SELECT DISTINCT ca.id AS id,ca.name AS name FROM catalbums ca,catfiles cf WHERE ca.id=cf.album AND cf.artist='".$myrow['artist']."' ORDER BY ca.name ASC";
		    $albumq = mysql_query($sql) or print(mysql_error());
		     while ($album = mysql_fetch_array($albumq)) {
		       if ($album['id']==$myrow['album']) {
			 echo '<option value="'.$album['id'].'" selected>'.$album['name'].'</option>';
		       } else {
			 echo '<option value="'.$album['id'].'">'.$album['name'].'</option>';
		       }
		     }

		   echo'</select>
		      </td>
		    </tr>
		    <tr>
		      <td width="17%">
			<div align="right"><i>Added by</i></div>
		      </td>
		      <td width="56%">
			<input type="text" name="addedby" size="30" maxlength="20" value="'.stripslashes($myrow['addedby']).'">
		      </td>
		    </tr>
		  </table>
		  <hr size="1" width="400">
		</div>
		<div align="center"><b>Type: '.$type2.'</b>
				<input type="hidden" name="type" value="'.$myrow['type'].'">
		  <hr size="1" width="400">
		  <i><font size="4">Content:</font></i></div>
		<p align="center">
		  <textarea name="content" rows="20" cols="80" wrap="PHYSICAL">'.stripslashes($myrow['content']).'</textarea>
		  <br>';

		  if ($myrow['status']=='0') {
		  echo '<input type="radio" name="approvefile" value="0" checked>Not Approved
		  &nbsp;<input type="radio" name="approvefile" value="1">Approved';
		  } else {
		  echo '<input type="radio" name="approvefile" value="0">Not Approved
		  &nbsp;<input type="radio" name="approvefile" value="1" checked>Approved';
		  }

		  echo '<br><br>
		  <input onclick="history.back()" type="button"  value="back">
		  <input type="submit" name="mode" value="update">
		  <input type="hidden" name="id" value="'.$id.'">
		  </form>';
} else {

    if ($mode=='approve') {

       $result = mysql_query("SELECT date FROM catfiles WHERE id=$id");
       $row = mysql_fetch_array($result);
       $filedate = $row['date'];

       $result = mysql_query("UPDATE catfiles
				     SET
				     status='1',
				     date='$filedate'
				     WHERE id='$id'
				     ");
       if(!$result) {
		    include('dberror.php');
		    exit;
		    } else {
			   header("Location: http://lyrics.nachtwind.net/files/$type/$id");
			}
}

if ($mode=='delete') {
    $result = mysql_query("DELETE FROM catfiles
			   WHERE id='$id'
			  ");
    if(!$result) {
	include('dberror.php');
	exit;
    } else {
			header("Location: http://lyrics.nachtwind.net/en/stats.php");
    }
}

if ($mode=='update') {

//convert any number of whitespaces to one single whitespace
//and remove whitespaces at beginning and end
$artist = ereg_replace (' +', ' ', $artist);
$title = ereg_replace (' +', ' ', $title);
$album = ereg_replace (' +', ' ', $album);
$addedby = ereg_replace (' +', ' ', $addedby);
$content = ereg_replace (' +', ' ', $content);
$artist = trim($artist);
$title = trim($title);
$album = trim($album);
$addedby = trim($addedby);
$content = trim($content);

//validate fields
if (ereg(".", $content) == 0)
	{
	     print 'You forgot to fill in the contents.';
	     print '<br><input onclick="history.back()" type="button"  value="Try again">';
	     exit;
	}

if (ereg(".", $artist)	  == '')    { $artist='(unknown)'; }
if (ereg(".", $title)	  == '')    { $title='(unknown)'; }
if (ereg(".", $addedby)   == '')    { $addedby='(unknown)'; }

//prepare data
//single quotes not marked as a special character produce a mySQL error
//if magic_quotes_gpc is not enabled (which really sucks)
if (!get_magic_quotes_gpc())
    {
			    $artist = addslashes($artist);
			    $title = addslashes($title);
			    $addedby = addslashes($addedby);
			    $content = addslashes($content);
    }

    $result = mysql_query("SELECT date FROM catfiles WHERE id=$id");
    $row = mysql_fetch_array($result);
    $filedate = $row['date'];

    mysql_query("UPDATE catfiles
			   SET artist='$artist',
			       title='$title',
			       album='$album',
			       content='$content',
			       status='$approvefile'
			       WHERE id='$id'
			  ");

    if ($approvefile=='yes') {
    mysql_query("UPDATE catfiles SET status='1' WHERE id='$id'");
    }

    mysql_query("UPDATE catfiles SET date='$filedate' WHERE id='$id'");

   header("Location: http://lyrics.nachtwind.net/files/$type/$id");
   }
}

if ($mode=='special') {
  $r = mysql_query("SELECT content FROM catfiles WHERE id='$id'");
  $content = mysql_result($r,0);

  if ($submode=='rmslashes' || $submode=='smart') $content = stripslashes($content);

  //if ($submode=='rmnonalpha' || $submode='smart') $content = preg_replace("![^A-Za-z0-9\r\n()\.]!i","",$content);

  if ($submode=='lower' || $submode=='smart') {
    $content = strtolower($content);
	$content = preg_replace("/([ \n])i([ '´`])/","$1I$2",$content);
  }

  if ($submode=='ucfirst' || $submode=='smart') {
    $content = explode("\n",$content);
    for ($i=0;$i<sizeof($content);$i++) $content[$i] = ucfirst($content[$i]);
    $content = implode("\n",$content);
  }

  if ($submode=='stringreplace') {
    $content = str_replace(stripslashes($string1),stripslashes($string2),$content);
  }

  if ($submode=='regexreplace') {
    $content = preg_replace(stripslashes($pattern),stripslashes($replace),$content);
  }

  $content = addslashes($content);

  mysql_query("UPDATE catfiles SET content='$content' WHERE id='$id'") or die(mysql_error());
  header("Location: http://lyrics.nachtwind.net/files/1/$id");
}

ob_end_flush();
?>
</body>
</html>
