<?php include('language.inc.php'); require('../config.inc.php');
$result['1'] = mysql_query("SELECT name FROM users");
if ($result['1']) {
   while ($data = mysql_fetch_array($result['1'])) {
         $currentuser = $data['name'];
         $result['2'] = mysql_query("SELECT count(*) FROM catfiles WHERE addedby='$currentuser'");
         $num_submitted = mysql_result($result['2'],0);
         mysql_query("UPDATE users SET num_submitted='$num_submitted'");
   }
}
?>

