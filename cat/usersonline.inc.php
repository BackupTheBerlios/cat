<?php

$uo = '';

if (isset($HTTP_COOKIE_VARS['user']) && isset($HTTP_COOKIE_VARS['pass'])) {
  $tempusername = $HTTP_COOKIE_VARS['user'];
  $temppassword = $HTTP_COOKIE_VARS['pass'];

  $db->query("SELECT id,name FROM catusers
               WHERE name='$tempusername'
               AND pass='$temppassword'");


    if ($db->num_rows()>0) {
      $db->next_record();
      $userstring = $db->record['name'];
      $userid = $db->record['id'];
      $db->query("SELECT time FROM cat_whosonline WHERE user_id='$userid'") or die($db->error());
      if ($db->num_rows()==0) {
        $db->query("INSERT INTO cat_whosonline SET user_id='$userid',ip='$REMOTE_ADDR',time=NOW(),current_site='".addslashes($pagetitle)."'") or die($db->error());
      } else {
        $db->query("UPDATE cat_whosonline SET ip='$REMOTE_ADDR',time=NOW(),current_site='".addslashes($pagetitle)."' WHERE user_id='$userid'") or die($db->error());
      }
    } else {
		$userstring = '<a href="../en/login.php">Login</a>';
		$db->query("SELECT time FROM cat_whosonline WHERE ip='$REMOTE_ADDR'");
      if ($db->num_rows()==0) {
        $db->query("INSERT INTO cat_whosonline SET user_id=0,ip='$REMOTE_ADDR',time=NOW(),current_site='".addslashes($pagetitle)."'") or die($db->error());
      } else {
        $db->query("UPDATE cat_whosonline SET user_id=0,time=NOW(),current_site='".addslashes($pagetitle)."' WHERE ip='$REMOTE_ADDR'") or die($db->error());
      }
    }
  } else {
    $userstring = '<a href="../en/login.php">Login</a>';
    $db->query("SELECT time FROM cat_whosonline WHERE ip='$REMOTE_ADDR'") or die($db->error());
    if ($db->num_rows()==0) {
      $db->query("INSERT INTO cat_whosonline SET user_id=0,ip='$REMOTE_ADDR',time=NOW(),current_site='".addslashes($pagetitle)."'") or die($db->error());
    } else {
      $db->query("UPDATE cat_whosonline SET user_id=0,time=NOW(),current_site='".addslashes($pagetitle)."' WHERE ip='$REMOTE_ADDR'") or die($db->error());
    }
  }


$db->query("SELECT user_id,current_site FROM cat_whosonline WHERE DATE_ADD(time,INTERVAL 180 SECOND)>=NOW() ORDER BY id DESC") or die($db->error());
while ($db->next_record()) {
  $tempid = $db->record['user_id'];
  if ($tempid=='0')
  {
    $uo .= '<span title="'.$db->record['current_site'].'">'.$lang['guest'].'</span>, ';
  }
  else
  {
	$cursite = $db->record['current_site'];
    $db->query("SELECT name FROM catusers WHERE id='$tempid'");
    $uo .= '<span title="'.$cursite.'">'.$db->result().'</span>, ';
  }
}

$design->addVar("basic", "USERSONLINE", substr($uo,0,strlen($uo)-2));

?>
