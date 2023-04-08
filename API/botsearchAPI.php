<?php
/* 
Write a PHP API code in English that includes the following:
Import the PHP file ../config.inc.php
Connect to the database using the DB_HOST, DB_USER, DB_PASSWORD, and DB_SCHEMA variables
Prevent SQL injection in the code
Check if a 'botsearch' parameter has been passed through GET and it's not empty. If yes, randomly select 12 rows of id, name, and description columns from the 'aibots' table, print the data as JSON, and return it.
If a 'botsearch' parameter has been passed through GET and it's not empty, assign it to the $botsearch variable. Then, select a maximum of 12 rows of id, name, and description columns from the 'aibots' table where the name or description columns contain the $botsearch value, print the data as JSON, and return it.

写一段php的api代码
代码内的语言是英文
引入php文件../config.inc.php
数据库连接的地址是DB_HOST，用户名是DB_USER，密码是DB_PASSWORD，数据库名是DB_SCHEMA
代码要防止sql注入
判断有传递get的botsearch参数，并且不等于空，如果不是，那么从aibots数据表里随机取出12行数据的id列，name列和description列，打印为json数据后返回
如果有get的botsearch参数，那么赋值给$botsearch变量，在aibots数据表里取出最多12行name列或者description列中包含$botsearch的数据的id列，name列和description列，打印为json数据后返回
*/

// Import configuration file
require_once('../config.inc.php');

// Establish database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);

// Check for SQL injection in botsearch parameter
$botsearch = isset($_GET['botsearch']) ? mysqli_real_escape_string($conn, $_GET['botsearch']) : '';

if (!empty($botsearch)) {
  // Search for matching data in aibots table
  $query = "SELECT id, name, description FROM aibots WHERE name LIKE '%$botsearch%' OR description LIKE '%$botsearch%' LIMIT 12";
} else {
  // Randomly select 12 rows from aibots table
  $query = "SELECT id, name, description FROM aibots ORDER BY RAND() LIMIT 12";
}

// Execute query and fetch results
$result = mysqli_query($conn, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Return data as JSON
echo json_encode($data);
mysqli_close($conn);
