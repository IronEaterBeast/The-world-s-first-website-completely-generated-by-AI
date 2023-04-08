<?php
/* 
Write a PHP API program in English that:
Accepts data posted via HTTP POST method, including email and password.
Checks if the email and password parameters are included in the POST data, and returns an error message if either is missing.
Calls the ../PHPClass/UserClass.php file.
Instantiates a class named User.
Calls the login method of the User class, passing in the email and password parameters as the first and second arguments, respectively.
Returns the return value of the login method as the API response.


写一个php的api
程序使用英文
接收post过来的数据，包括email和password，需要判断是post方法，需要判断email和password两个post数据存在，否则返回错误原因
调用../PHPClass/UserClass.php
实例化一个名叫User的类
调用User类的login方法，第一个参数传入邮箱名，第二个参数传入密码
api返回login方法的返回值
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Only POST requests are allowed.');
}

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    exit('Both email and password must be provided.');
}

require_once('../PHPClass/UserClass.php');

$user = new User();

$result = $user->login($_POST['email'], $_POST['password']);

echo json_encode($result);
