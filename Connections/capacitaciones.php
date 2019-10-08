<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_capacitaciones = "localhost";
$database_capacitaciones = "capacitaciones";
$username_capacitaciones = "root";
$password_capacitaciones = "";
$capacitaciones = mysql_pconnect($hostname_capacitaciones, $username_capacitaciones, $password_capacitaciones) or trigger_error(mysql_error(),E_USER_ERROR); 
?>