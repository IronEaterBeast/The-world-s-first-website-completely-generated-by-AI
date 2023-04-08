<?php

/* 
Create a PHP configuration file in English that can set up the basic information for a MYSQL database.
Open the session in PHP.
Use UTC time.

建立一个php配置文件，使用英文，里面可以设置MYSQL数据库的基本信息
打开php的session
使用UTC时间
*/


// Database configuration
define("DB_HOST", "localhost"); // Database server host name
define("DB_USER", "root"); // Database username
define("DB_PASSWORD", "654321"); // Database password
define("DB_SCHEMA", "aiopencenter"); // Database schema (database name)

session_start();

date_default_timezone_set('UTC'); 

?>
