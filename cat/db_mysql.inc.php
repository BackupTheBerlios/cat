<?
set_time_limit(0);

class db_sql
{
  var $host     = ""; // hostname of our mysql server.
  var $database = ""; // logical database name on that server.
  var $user     = ""; // user und password for login.
  var $password = "";

  var $link_id  = 0;  // result of mysql_connect().
  var $query_id = 0;  // result of most recent mysql_query().
  var $record   = array();  // current mysql_fetch_array()-result.
  var $row;           // current row number.

  var $errno    = 0;  // error state of query...
  var $error    = "";

        function halt($msg)
        {
                printf("</td></tr></table><b>database error:</b> %s<br>\n", $msg);
                printf("<b>mysql error</b>: %s (%s)<br>\n",
                $this->errno,
                $this->error);
                die("session halted.");
        }

        function connect()
        {
                if ( 0 == $this->link_id )
                {
                        $this->link_id=mysql_pconnect($this->host, $this->user, $this->password);
                        if (!$this->link_id)
                        {
                                $this->halt("link-id == false, connect failed");
                        }
                        if (!mysql_query(sprintf("use %s",$this->database),$this->link_id))
                        {
                                $this->halt("cannot use database ".$this->database);
                        }
                }
        }

        function query($query_string)
        {
                $this->connect();

                #printf("debug: query = %s<br>n", $query_string);
                //$query_string = mysql_escape_string($query_string);
                $this->query_id = mysql_query($query_string,$this->link_id);
                $this->row   = 0;
                $this->errno = mysql_errno();
                $this->error = mysql_error();
                if (!$this->query_id)
                {
                        $this->halt("invalid sql: ".$query_string);
                }

                return $this->query_id;
        }

        function next_record()
        {
                $this->record = mysql_fetch_array($this->query_id);
                $this->row   += 1;
                $this->errno = mysql_errno();
                $this->error = mysql_error();

                $stat = is_array($this->record);
                if (!$stat)
                {
                        mysql_free_result($this->query_id);
                        $this->query_id = 0;
                }

                return $stat;
        }

        function result()
        {
                return mysql_result($this->query_id,0,0);
        }

        function num_rows()
        {
                return mysql_num_rows($this->query_id);
        }

        function affected_rows()
        {
                return mysql_affected_rows($this->link_id);
        }

        function close()
        {
                #if($this->query_id)
                #{
                #        mysql_free_result($this->query_id);
                #}
                mysql_close($this->link_id);
        }


}
?>
