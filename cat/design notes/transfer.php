<?
include('config.inc.php');
header('content-type: text/plain');
/*$r = mysql_query("select id,name from catalbums");
while ($data = mysql_fetch_array($r)) {
  mysql_query("update catfiles set album='$data[id]' where album='".addslashes($data[name])."'");
  echo "Processing album $data[id]:$data[name], updated ".mysql_affected_rows($db)." rows.\n";
}*/

/*$r = mysql_query("SELECT id,name FROM catalbums") or die(mysql_error());
while ($data = mysql_fetch_array($r)) {
  $content = $data[name];
  $content = explode("\n",$content);
  for ($i=0;$i<sizeof($content);$i++) $content[$i] = ucfirst($content[$i]);
  $content = implode("\n",$content);
  mysql_query("UPDATE catalbums SET name='".addslashes($content)."' WHERE id='$data[id]'") or die(mysql_error());
  echo "Processing album $data[id]:$data[name], updated ".mysql_affected_rows($db)." rows.\n";
}*/
?>
