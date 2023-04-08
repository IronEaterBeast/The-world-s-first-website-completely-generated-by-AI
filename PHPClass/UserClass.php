<?php
/* 
Please write a PHP class that includes user-related operations such as registration, login, and logout. The name of the table for this class is "users". If the table does not exist, create it using the "utf8mb4_general_ci" and "MyISAM" encodings.
The language used in the code is English, and the "config.inc.php" file is imported. The database connection address is "DB_HOST", the username is "DB_USER", the password is "DB_PASSWORD", and the database name is "DB_SCHEMA".
The user data only includes the registration email and password. The PHP code needs to prevent SQL injection attacks, check that the email format is correct, and that the password is at least 6 characters long.
After a user successfully logs in or registers, set their login status in the session to "logged in", and the session never expires. The class should return the detailed reasons for failure of each operation, and if successful, return the user's ID in the database.
Write a method that takes an email as a parameter, uses it to search the "email" column in the "users" table, and returns the ID.

写一个php类，这个类包含了用户相关操作，比如注册，登录，注销，这个类的数据表名叫	users，如果这个表不存在就用utf8mb4_general_ci和MyISAM创建
代码内的语言是英文
引入php文件../config.inc.php
数据库连接的地址是DB_HOST，用户名是DB_USER，密码是DB_PASSWORD，数据库名是DB_SCHEMA
用户数据只有注册邮箱和密码
php代码需要防止SQL注入攻击
要检查邮箱格式正确
要检查密码不能少于6位字符
用户登录成功或者用户注册成功后要将用户在session中置为登录成功，这个session永不过期
类需要返回各个操作失败的详细原因，如果成功返回在数据库中的id
写一个方法，参数是email，使用email在users数据表的email列中进行查找，返回id
*/

require_once '../config.inc.php';

class User
{
    private $conn;

    public function __construct()
    {
        // create a database connection
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // create the users table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        if (!$this->conn->query($sql)) {
            die("Table creation failed: " . $this->conn->error);
        }
    }

    public function __destruct()
    {
        // close the database connection
        $this->conn->close();
    }

    public function register($email, $password)
    {
        // sanitize user input to prevent SQL injection attacks
        $email = $this->conn->real_escape_string($email);
        $password = $this->conn->real_escape_string($password);

        // check email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        }

        // check password length
        if (strlen($password) < 6) {
            return "Password must be at least 6 characters long";
        }

        // check if email already exists
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return "Email already exists";
        }

        // insert new user into database
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hash')";
        if ($this->conn->query($sql) === TRUE) {
            // set user as logged in
            $_SESSION['user'] = $email;
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function login($email, $password)
    {
        // sanitize user input to prevent SQL injection attacks
        $email = $this->conn->real_escape_string($email);
        $password = $this->conn->real_escape_string($password);

        // retrieve user from database
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // set user as logged in
                $_SESSION['user'] = $email;
                return true;
            }
        }
        return "Invalid email or password";
    }

    public function logout()
    {
        // unset the user session variable
        unset($_SESSION['user']);
        return true;
    }

    function findUserByEmail($email)
    {
        // Prepare SQL statement with a parameterized query to prevent SQL injection
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);  // Bind the parameter to the statement
        $stmt->execute();  // Execute the statement
        $stmt->store_result();  // Store the result set
        $stmt->bind_result($id);  // Bind the result to a variable
        $stmt->fetch();  // Fetch the result

        if ($stmt->num_rows == 1) {  // Check if one row was returned
            return $id;  // Return the user ID
        } else {
            return 0;  // User not found
        }
    }
}
