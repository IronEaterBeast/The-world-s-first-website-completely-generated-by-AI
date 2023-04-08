<?php
/* 
Write a PHP class named AIBot with the following specifications:

The code in the class should be written in English.
Import the PHP file '../config.inc.php'.
The database connection address is DB_HOST, username is DB_USER, password is DB_PASSWORD, and the database name is DB_SCHEMA.
This class includes a method named 'create', which accepts 5 parameters: the bot's name, description, prompt, example, and the ID of the user it belongs to. It checks that all 5 parameters exist and then saves them in the database.
The PHP code needs to prevent SQL injection attacks.
The class needs to return detailed error messages for any failed operations, and return the ID of the bot in the database if the operation is successful.
The AIBot class needs a MySQL table, which should be created in the initialization method of the class. If the table doesn't exist, it should be created.

写一个php类，名字叫做AIBot
代码内的语言是英文
引入php文件../config.inc.php
数据库连接的地址是DB_HOST，用户名是DB_USER，密码是DB_PASSWORD，数据库名是DB_SCHEMA
这个类包含了一个方法，名字叫做create，接收bot的名字，bot的描述，bot的Prompt，bot的Example，所属于的用户的id这5个参数，检查这5个参数都存在，然后保存在数据库中
php代码需要防止SQL注入攻击
类需要返回各个操作失败的详细原因，如果成功返回在数据库中的id
将aibot类需要的mysql数据表写在中类的初始化方法中，检查数据表不存在就建立
*/

class AIBot
{
    private $conn;

    function __construct()
    {
        require_once '../config.inc.php';

        // Create connection
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Create table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS `aibots` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `name` VARCHAR(255) NOT NULL,
                    `description` VARCHAR(255) NOT NULL,
                    `prompt` TEXT NOT NULL,
                    `example` TEXT NOT NULL,
                    `user_id` INT(11) NOT NULL,
                    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        $this->conn->query($sql);
    }

    function create($name, $description, $prompt, $example, $user_id)
    {
        // Check if all parameters exist
        if (empty($name) || empty($description) || empty($prompt) || empty($example) || !isset($user_id)) {
            return json_encode(array("false", "All parameters are required."));
        }

        // Prevent SQL injection
        $name = $this->conn->real_escape_string($name);
        $description = $this->conn->real_escape_string($description);
        $prompt = $this->conn->real_escape_string($prompt);
        $example = $this->conn->real_escape_string($example);
        $user_id = intval($user_id);

        // Insert record into database
        $sql = "INSERT INTO `aibots` (`name`, `description`, `prompt`, `example`, `user_id`)
                VALUES ('$name', '$description', '$prompt', '$example', $user_id)";
        if ($this->conn->query($sql) === TRUE) {
            return json_encode(array("true", $this->conn->insert_id));
        } else {
            return json_encode(array("false", "Error creating AI bot: " . $this->conn->error));
        }
    }

    function __destruct()
    {
        // Close connection
        $this->conn->close();
    }
}
