<?php
  //update counter
  if (!isset($HTTP_COOKIE_VARS['count'])) {
    setcookie('count','yes',time()+24*60*60,'',$domainname,0);
    $result = mysql_query('SELECT * FROM catcounter');
    $row = mysql_fetch_array($result);
    $number = $row['counter']+1;
    mysql_query("UPDATE catcounter SET counter = '$number'");
  }

  //insert visitor information
  if (!isset($HTTP_COOKIE_VARS['user']))
    $HTTP_COOKIE_VARS['user'] = '(unknown)';

  if (!getenv('HTTP_REFERER')) {
    $HTTP_REFERER = '(direct)';
  } else {
    $HTTP_REFERER = getenv('HTTP_REFERER');
  }

  mysql_query("INSERT INTO catvisitors SET
                      site = '$pagetitle',
                      referer  ='$HTTP_REFERER',
                      username ='".$HTTP_COOKIE_VARS['user']."'");
?>
