<?php
/* 
Write a PHP API program in English that:
Receives data via POST method, including email and password
Verifies that email and password POST data exist; otherwise, returns an error message
Calls ../PHPClass/UserClass.php
Instantiates the User class from UserClass
Calls the register method of User class, passing in the email and password as the first and second parameters, respectively
Returns the return value of the register method.

写一个php的api
程序使用英文
接收post过来的数据，包括email和password，需要判断是post方法，需要判断email和password两个post数据存在，否则返回错误原因
调用../PHPClass/UserClass.php
实例化UserClass的User类
调用User类的register方法，第一个参数传入邮箱名，第二个参数传入密码
api返回register方法的返回值
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Only POST requests are allowed.");
}

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    exit("Both 'email' and 'password' fields are required.");
}

require_once('../PHPClass/UserClass.php');

$user = new User();
$result = $user->register($_POST['email'], $_POST['password']);

echo json_encode($result);
