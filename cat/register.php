<? ob_start(); include('language.inc.php'); $pagetitle = 'Register Account'; include('page_header.inc.php'); ?>

<?php
if (isset($_POST['step'])) {
 if ($_POST['step']=='2') {

         //check for empty fields
         if (   !eregi('.', $username)
             || !eregi('.', $password1)
             || !eregi('.', $password2)
             ) {
                print 'You did not fill in all fields.<br>Please <a href="javascript:history.back()">try again</a>';
                exit;
         }

         //check for length
         if (strlen($username)<3) {
                print 'Your username must contain at least 3 characters.<br>Please <a href="javascript:history.back()">try again</a>';
                exit;
         }

         if (strlen($password1)<6 || strlen($password2)<6) {
                print 'Your password must contain at least 6 characters.<br>Please <a href="javascript:history.back()">try again</a>';
                exit;
         }

         //check for bad characters
         if (   !eregi('(^)([a-zA-Z0-9_])|(_)($)', $username)
             || !eregi('(^)([a-zA-Z0-9_])|(_)($)', $password1)
             || !eregi('(^)([a-zA-Z0-9_])|(_)($)', $password2)
             ) {
                print 'Sorry, no characters other than letters, numbers and underscores allowed.<br>Please <a href="javascript:history.back()">try again</a>';
                exit;
         }

         //check for whitespaces
         if (   eregi(' ', $username)
             || eregi(' ', $password1)
             || eregi(' ', $password2)
             ) {
                print 'Sorry, no spaces in any field allowed.<br>Please <a href="javascript:history.back()">try again</a>';
                exit;
         }

         //check passwords
         if ($password1 != $password2) {
                print 'Your password fields do not match, check for typos.<br>Please <a href="javascript:history.back()">try again</a>';
                exit;
         }

         //check if email is correct
/*         if (eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](g|l|m|pa|t|u|v)?$", $email, $check)) {
         if (checkdnsrr(substr(strstr($check['0'], '@'), 1), "ANY")) {
               $validemail=TRUE;
               }
         } else {
               $validemail=FALSE;
         }

         if (!$validemail) {
                print 'Sorry, the email address you specified is not valid.<br>Please <a href="javascript:history.back()">try again</a>';
                exit;
         }*/

         //create user
         if ($recv_newsletter) { $recv_newsletter = '1'; } else { $recv_newsletter = '0'; }
         $reg_date=date('Y-m-d');
         $sql = "INSERT INTO catusers (name,pass,email,recv_newsletter,reg_date)
                 VALUES ('$username','$password1','$email','$recv_newsletter','$reg_date')";

         $result = mysql_query($sql);
         if (!$result) {
             include('dberror.php');
         }

         //set the cookie
         setcookie('user',$row['name'],$cookie_expires,$cookiepath,$domainname,0);
         setcookie('pass',$row['pass'],$cookie_expires,$cookiepath,$domainname,0);

         //finally start sending to browser, only for php
         ob_end_flush();

         //print confirmation
         print 'Dein Account wurde erstellt und Du wurdest automatisch eingeloggt.';

 }

} else {
?>
              <table width="92%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td height="104" valign="middle">
                    <div align="center"><b><font face="Verdana, Arial, Helvetica, sans-serif">Welcome
                      to our user registration page!<br>
                      Registration is not required, but offers many benefits:
                      You can customize the look of your CAT pages, add bookmarks
                      to files you access often and much more!</font></b></div>
                  </td>
                </tr>
              </table>
              <font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><br>
              </b></font>

              <form name="form2" method="post" action="<?=$PHP_SELF?>">
                <table width="92%" border="0" cellspacing="3" cellpadding="4" align="center">
                  <tr bgcolor="#003366">
                    <td width="33%" nowrap>
                      <div align="right"><i>Your username</i></div>
                    </td>
                    <td width="67%">
                      <input type="text" name="username" size="30" maxlength="20">
                    </td>
                  </tr>
                  <tr bgcolor="#003366">
                    <td width="33%" nowrap>
                      <div align="right"><i>Your password</i></div>
                    </td>
                    <td width="67%">
                      <input type="password" name="password1" size="30" maxlength="20">
                    </td>
                  </tr>
                  <tr bgcolor="#003366">
                    <td width="33%" nowrap>
                      <div align="right"><i>Your password again:</i></div>
                    </td>
                    <td width="67%">
                      <input type="password" name="password2" size="30" maxlength="20">
                    </td>
                  </tr>
                  <tr bgcolor="#003366">
                    <td width="33%" nowrap>
                      <div align="right"><i>eMail (can be set to private)</i></div>
                    </td>
                    <td width="67%">
                      <input type="text" name="email" size="40" maxlength="100">
                    </td>
                  </tr>
                  <tr bgcolor="#003366">
                    <td width="33%" nowrap height="25">
                      <div align="right"><i>Do you want to receive our weekly
                        newsletter?</i></div>
                    </td>
                    <td width="67%" height="25">
                      <input type="checkbox" name="recv_newsletter" value="yes" checked>
                    </td>
                  </tr>
                  <tr bgcolor="#003366">
                    <td width="33%" valign="middle" nowrap height="47">
                      <div align="right">
                        <input type="hidden" name="step" value="2">
                      </div>
                    </td>
                    <td width="67%" height="47">
                      <input type="submit" name="Submit2" value="Register">
                      <i>(Cookies müssen aktiviert sein)</i> </td>
                  </tr>
                </table>
                          </form>
              <font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b>
              </b></font>
<?php }
include('page_footer.inc.php'); ?>
