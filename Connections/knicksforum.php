<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_knicksforum = "localhost";
$database_knicksforum = "leabo";
$username_knicksforum = "smleabo";
$password_knicksforum = "cis231";
$knicksforum = mysql_connect($hostname_knicksforum, $username_knicksforum, $password_knicksforum) or trigger_error(mysql_error(),E_USER_ERROR); 
?>