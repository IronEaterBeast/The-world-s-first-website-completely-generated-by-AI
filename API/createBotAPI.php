<?php
/* 
Write a PHP API program in English that:
Accepts POST data, including name, description, prompt, and example as four parameters. It should check if it is a POST method and if these four POST data exist; otherwise, it returns the error reason.
Calls ../PHPClass/UserClass.php.
Instantiates a class named User.
Checks whether $_SESSION['user'] exists. If it does, it calls the findUserByEmail method of User, passes in $_SESSION['user'] as a parameter, and saves the return value in the $user_id variable. If it does not exist, set $user_id to 0.
Calls ../PHPClass/AIBotClass.php.
Instantiates a class named aibot.
Calls the create method of aibot class, passing in $name, $description, $prompt, $example, and $user_id as five parameters.
The API returns the return value of the create method.

写一个php的api
程序使用英文
接收post过来的数据，包括name，description，prompt，example这4个参数，需要判断是post方法，需要判断这4个post数据都存在，否则返回错误原因
调用../PHPClass/UserClass.php
实例化一个名叫User的类
检查是否存在$_SESSION['user']，如果存在，调用User的findUserByEmail方法，将$_SESSION['user']作为参数传入，将返回值保存在$user_id变量中，如果不存在，将$user_id置为0
调用../PHPClass/AIBotClass.php
实例化一个名叫aibot的类
调用aibot类的create方法，依次传递$name, $description, $prompt, $example, $user_id这5个参数
api返回create方法的返回值
*/

// Check if this is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo 'Error: This API endpoint only accepts POST requests.';
    exit();
}

// Check if all required parameters are present
if (!isset($_POST['name'], $_POST['description'], $_POST['prompt'], $_POST['example'])) {
    http_response_code(400);
    echo 'Error: Missing one or more required parameters.';
    exit();
}

// Include necessary class files
require_once('../PHPClass/UserClass.php');
require_once('../PHPClass/AIBotClass.php');

// Check if user is logged in
$user_id = 0;
if (isset($_SESSION['user'])) {
    $user = new User();
    $user_id = $user->findUserByEmail($_SESSION['user']);
}

// Instantiate AIBot class and create new bot
$aibot = new AIBot();
$result = $aibot->create($_POST['name'], $_POST['description'], $_POST['prompt'], $_POST['example'], $user_id);

// Return result
echo $result;
