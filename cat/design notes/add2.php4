<?php require('../config.inc.php4'); ?>
<html><!-- #BeginTemplate "/Templates/en_ie.dwt" -->
<head>
<!-- #BeginEditable "doctitle" -->
<title>CAT Music Files - Your central source for lyrics, guitar tabs, chords and bass tabs</title>
<!-- #EndEditable -->
<?php include('../metatags.inc.htm'); ?>

<script language="JavaScript">
<!--
function framekiller() {
if(parent != null && parent != self) {
var host=parent.location.hostname;
if(host != "pluto.phpwebhosting.com") 
                    {
window.location.href=self.location.href;
}
}
}
//-->
</script>
</head>

<body onLoad="framekiller()" bgcolor="#111144" text="#eeeeee" link="#FFCC66" vlink="#FFCC66" background="../images/back3.jpg">
<div align="left">
  <table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="48" valign="middle" width="201"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#FFCC33" size="4"><a href="http://www.cat-lyrics.de.tf/"><font color="#CCCC66"><img src="../images/cat2.gif" width="90" height="40" border="0" align="middle" alt="CAT Logo"></font></a></font></b></font></div>
      </td>
      <td height="48" valign="middle" width="549"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#FFCC33" size="4"><a href="http://www.cat-lyrics.de.tf/"><font color="#CCCC66"> 
          <font size="5" color="#FFCC33">CAT MUSIC FILES</font></font></a></font></b></font></div>
      </td>
    </tr>
  </table>
  <table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td height="351" valign="top"> 
        <div align="left"> <img src="../images/divider3.gif" width="100%" height="15" alt="Divider"> 
          <table width="750" cellspacing="0" cellpadding="0" align="center">
            <tr align="left" valign="middle"> 
              <td height="106" width="157"> 
                <form name="form1" method="get" action="../en/search<?=$scriptext?>">
                  <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><b><font size="2">Quicksearch</font><br>
                    </b></font> 
                    <input type="text" name="quickquerystring" maxlength="60" size="15">
                    <br>
                    <input type="hidden" name="mode" value="quick">
                    <input type="hidden" name="s_lyrics" value="yes">
                    <input type="hidden" name="s_tabs" value="yes">
                    <input type="hidden" name="s_chords" value="yes">
                    <input type="hidden" name="s_btabs" value="yes">
                  </div>
                </form>
                <p align="center">
<?php
print '<i><font size="2">';
			if ($HTTP_COOKIE_VARS['user'] && $HTTP_COOKIE_VARS['pass']) {
               	$tempusername = $HTTP_COOKIE_VARS['user'];
               	$temppassword = $HTTP_COOKIE_VARS['pass'];

               	$result = mysql_query("SELECT name FROM catusers
                             WHERE name='$tempusername'
                             AND pass='$temppassword'");
		
			   	if ($result) {
			   		if (mysql_num_rows($result)>0) {
						$row = mysql_fetch_array($result);
			   			print $row['name'];
					} else {
						print 'Not logged in.';
					}
			   	} else {
					print 'Not logged in.';
				}
} else {
		print 'Not logged in.';
}
print '</i></font>';						
?>				
				</p>
              </td>
              <td height="106" width="142"> 
                <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><a href="../en/stdsearch<?=$scriptext?>">Search</a><br>
                  <a href="../en/artistbrowse<?=$scriptext?>">Browse</a><br>
                  <a href="../en/add<?=$scriptext?>">Submit</a></b></font></div>
              </td>
              <td height="106" width="149"> 
                <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><a href="../en/register<?=$scriptext?>">Register</a></b></font></b></font><br>
                  <font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><a href="../en/login<?=$scriptext?>">Login</a></b></font><a href="../en/apboard/main<?=$scriptext?>"><br>
                  </a><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><a href="../en/mypage<?=$scriptext?>">My 
                  Page</a></b></font></b></font></b></font></div>
              </td>
              <td height="106" width="150"> 
                <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b> 
                  <a href="../en/faq<?=$scriptext?>">FAQ</a><br>
                  Guestbook</b></font></b></font></div>
              </td>
              <td height="106" width="150"> 
                <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><a href="../en/staff<?=$scriptext?>">Staff</a></b></font></b></font><br>
                  <font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><a href="../en/stats<?=$scriptext?>">Statistics</a></b></font><a href="../en/apboard/main<?=$scriptext?>"><br>
                  </a><font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><a href="../en/legal<?=$scriptext?>">Legal</a></b></font></b></font></b></font></div>
              </td>
            </tr>
          </table>
        </div>
        <img src="../images/divider3.gif" width="100%" height="15" alt="Divider"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr valign="middle"> 
            <td height="19">&nbsp;</td>
          </tr>
          <tr> 
            <td valign="top" width="80%" height="216"><!-- #BeginEditable "content" -->
              <?php

//requires
require('../functions.inc'.$scriptext);

//convert any number of whitespaces to one single whitespace
//and remove whitespaces at beginning and end
$artist = ereg_replace (' +', ' ', $artist);
$title = ereg_replace (' +', ' ', $title);
$album = ereg_replace (' +', ' ', $album);
$addedby = ereg_replace (' +', ' ', $addedby);
if ($type=='1') {
    $content = ereg_replace (' +', ' ', $content);
}

$artist=trim($artist);
$title=trim($title);
$album=trim($album);
$addedby=trim($addedby);
if ($ype=='1') {
    $content=trim($content);
}

//validate fields
if (ereg(".", $content) == 0)
        {
        print 'You forgot to fill in the contents.';
        print '<br><input onclick="history.back()" type="button"  value="Try again">';
        exit;
        }

if (ereg(".", $artist)    == '')    { $artist='(unknown)'; }
if (ereg(".", $title)     == '')    { $title='(unknown)'; }
if (ereg(".", $album)     == '')    { $album='(unknown)'; }
if (ereg(".", $addedby)   == '')    { $addedby='(unknown)'; }

//prepare data
//single quotes not marked as a special character produce a mySQL error
//if magic_quotes_gpc is not enabled (which really sucks)
if (!get_magic_quotes_gpc())
    {
    $artist = ereg_replace("(')", "\'", $artist);
    $title = ereg_replace("(')", "\'", $title);
    $album = ereg_replace("(')", "\'", $album);
    $addedby = ereg_replace("(')", "\'", $addedby);
    $content = ereg_replace("(')", "\'", $content);
    }

//strip out HTML tags
$content = eregi_replace("(<)(.*)(>)","",$content);

//update num_submitted
$sql = "SELECT num_submitted FROM catusers
        WHERE name='$addedby'";
$result = mysql_query($sql);
if ($result) {
    $row = mysql_fetch_array($result);
}

$number = $row['num_submitted'] + 1;

$sql = "UPDATE catusers
        SET num_submitted='$number'
        WHERE name = '$addedby'
        ";

$result = mysql_query($sql);


//insert file
$sql = "INSERT INTO catfiles (type,artist,title,album,addedby, content)
        VALUES ('$type','$artist','$title','$album','$addedby','$content')";

$result = mysql_query($sql);

if(!$result) {
    include('dberror.php4');
    exit;
} else {
    print '<font size="4"><b>I added your file! Thank you very much.</b></font><br><hr size="1">';
        print '<b><i><br><font size="4">You can now choose to:</font></i></b>';
        print '<ul><li><b><i><a href="add'.$scriptext.'">Submit another file</a><i></b></li>';
        print '<li><b><i><a href="index'.$scriptext.'">Go to the start page</a><i></b></li></ul><br>';
    }

?>
              <!-- #EndEditable --></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
<!-- #EndTemplate --></html>
