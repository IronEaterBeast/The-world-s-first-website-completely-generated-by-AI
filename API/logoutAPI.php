<?php
/* 
Write a PHP API program in English that:
calls ../PHPClass/UserClass.php
instantiates the User class
calls the logout method of the User class
returns JSON data indicating success (true) or failure (false) of the communication

写一个php的api
程序使用英文
调用../PHPClass/UserClass.php
实例化User类
调用User类的logout方法
api返回json数据，如果通信成功，api返回true，如果通信失败，api返回false
*/

// Include the UserClass.php file
require_once('../PHPClass/UserClass.php');

// Instantiate the User class
$user = new User();

// Call the logout method on the User instance
$logout_success = $user->logout();

// Prepare the response data as a JSON string
$response_data = json_encode($logout_success ? true : false);

// Set the response headers
header('Content-Type: application/json');

// Output the response data
echo $response_data;


?>
