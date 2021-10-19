<?php
define('DBHost', 'localhost');
define('DBPort', 3306);
define('DBName', 'findbug');
define('DBUser', 'root');
define('DBPassword', '');
$DB = new Db(DBHost, DBPort, DBName, DBUser, DBPassword);
?>