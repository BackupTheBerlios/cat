<html>
<body>
There seems to be a slight problem with the database.<br>
Please try again by pressing the refresh button in your browser.<br>
An eMail has been dispatched to our <a href="mailto:webmaster@nachtwind.net">Technical Staff</a>, whom you can also contact if the problem persists.
<br><br>
We apologize for any inconvenience.
<?php
$username = $HTTP_COOKIE_VARS['user'];
$password = $HTTP_COOKIE_VARS['pass'];
$errortime = date ("M d Y H:i:s");
mail("webmaster@nachtwind.net",
  "CAT Database Error",
  "A database error occured.\n\n
   Username: $username\n
   Password: $password\n
   Time: $errortime\n\n\n
   Query entered: $sql\n\n
   MySQL said: ".mysql_error());

?>
</body>
</html>