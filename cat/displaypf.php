<?php
include('language.inc.php');
require('../config.inc.php');

echo "<html><head><title>CAT Music Files - $lang['displaypf']['pagetitle']</title></head><body>";

$data = mysql_fetch_array(mysql_query("SELECT artist,title,album,content FROM catfiles WHERE id=$id")) or die(mysql_error());
$data['content'] = preg_replace("/(\015\012)|(\012)|(\015)/","<br>",$data['content']);

if ($type != 1) {
  $data['content'] = str_replace(' ','&nbsp;',$data['content']);
}

echo '<br><table width="750" border="0" cellspacing="0" cellpadding="0" align="center">';
echo '<tr><td valign="top">';
echo "<p><span style=\"font-size:16px; font-color:#000000\"></span><br>$data['artist']<br>
          <span style=\"font-size:25px;\">$data['title']</span><br><span style=\"font-size:16px; font-style:italic; font-color:#000000\">$data['album']</span></p><hr height=\"1\" width=\"250\" align=\"left\">";

switch ($type) {
  case '1':
  print '<p style="font-color:#000000;">';
  break;

  case ('2'||'3'||'4'):
  print '<p style="font-color:#000000; font-size:11px; font-family:Courier New,Courier,mono;">';
  break;
}

echo "$data['content']</p></td></tr></table></body></html>";
