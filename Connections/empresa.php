<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_empresa = "localhost";
$database_empresa = "empresa";
$username_empresa = "root";
$password_empresa = "";
$empresa = mysql_pconnect($hostname_empresa, $username_empresa, $password_empresa) or trigger_error(mysql_error(),E_USER_ERROR); 
?>