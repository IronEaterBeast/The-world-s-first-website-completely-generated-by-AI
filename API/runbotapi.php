<?php
/* 
We have introduced Orhanerday\OpenAi\OpenAi, but it has some problems with SSL. You need to add the statement CURLOPT_SSL_VERIFYPEER => false in $curl_info of the file vendor\orhanerday\open-ai\src\OpenAi.php. After completion, it will look like this:
$curl_info = [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => '',
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => $this->timeout,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => $method,
    CURLOPT_POSTFIELDS     => $post_fields,
    CURLOPT_HTTPHEADER     => $this->headers,
    CURLOPT_SSL_VERIFYPEER => false,
];

我们引入了Orhanerday\OpenAi\OpenAi，但是它在ssl方面有一点问题，你需要在vendor\orhanerday\open-ai\src\OpenAi.php文件的$curl_info中添加CURLOPT_SSL_VERIFYPEER => false,语句，完成以后大概是这样
$curl_info = [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => '',
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => $this->timeout,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => $method,
    CURLOPT_POSTFIELDS     => $post_fields,
    CURLOPT_HTTPHEADER     => $this->headers,
    CURLOPT_SSL_VERIFYPEER => false,
];
*/

/* 
Write a PHP API code in English with the following requirements:
The language used in the code is English.
Import the PHP file '../config.inc.php'.
The database connection address is DB_HOST, username is DB_USER, password is DB_PASSWORD, and the database name is DB_SCHEMA.
Check if there is a GET parameter called 'bid'. If not, the program returns false.
Convert the GET parameter 'bid' to an integer and assign it to the $botid variable. Check if $botid is greater than 0. If not, the program returns false.
Check if there is a GET parameter called 'qu'. If there is, assign it to the $qu variable. If not, the $qu variable is set to 'Hello.'
Retrieve the row from the 'aibots' table where the 'id' column equals $botid. If it does not exist, the program returns false. If it does, assign the value of the 'prompt' column to the $prompt variable.
Send the stream header and the no-cache header.
Check if the 'aiaccesslog' table exists in the database. If it does not, create it using utf8mb4 encoding with two columns, 'botid' and 'timestamp', where 'timestamp' is an int data type. Do not use foreign keys.
Retrieve the maximum timestamp from all data in the 'aiaccesslog' table without the 'WHERE botid = $botid' condition. If there is no data, set $lastTime to 0. If there is data, set $lastTime to the maximum timestamp.
Subtract $lastTime from the current timestamp and assign it to the $intv variable. If $intv is less than 10 seconds, calculate 10-$intv and assign it to $waitSec. Assign the English string 'Due to resource limitations, there must be a 10-second wait between two robot executions on the website. A user executed a robot within $intv seconds. Please wait another $waitSec seconds.' to the $infoString variable. Split $infoString by space and assign the resulting array to $infoStringArray. Loop through $infoStringArray, add a space to each value, and assign it to $sysInfo["choices"][0]["delta"]["content"]. Convert $sysInfo to a JSON string, add 'data: ' before each JSON string and add '\n\n' after each JSON string, then output them. Flush the output buffer, clear the buffer, and wait for 100 milliseconds. Terminate the program after the loop is complete.
Add a new record to 'aiaccesslog' at the end of the program.

写一段php的api代码
代码内的语言是英文
引入php文件../config.inc.php
数据库连接的地址是DB_HOST，用户名是DB_USER，密码是DB_PASSWORD，数据库名是DB_SCHEMA
判断是否有GET传递的bid参数如果没有，程序返回false
将GET传递的bid参数转换为整数，然后赋予$botid变量，判断$botid大于0，否则程序返回false;判断是否有GET传递的qu参数，如果有将qu赋予$qu变量，如果没有$qu变量等于“Hello.”
从aibots表中取出id列等于$botid的行，如果没有，程序返回false，如果有，将prompt列的值赋给$prompt变量
发送stream的header，发送没有缓存的header
查询数据库中aiaccesslog数据表是否存在，如果不存在，用utf8mb4的方式建立，其中有两列botid和timestamp，其中timestamp是个int数据类型，不要使用外键
从aiaccesslog数据表中取出所有数据中最大的timestamp，不要带“WHERE botid = $botid”，如果取出数据为空，将$lastTime置为0，如果不为空，将$lastTime置为最大的timestamp
将当前的timestamp减去$lastTime赋值给$intv，如果$intv小于10秒，计算10-$intv赋值给$waitSec，将“由于资源限制，网站两次机器人执行之间需等待10秒，某用户在$intv秒之前执行了机器人，请再等待$waitSec秒”的英文赋给变量$infoString。将$infoString按照空格分隔为数组赋值给$infoStringArray，循环$infoStringArray，将每一个值后面加上一个空格赋值给$sysInfo["choices"][0]["delta"]["content"]，将$sysInfo变为json字符串，在每个$sysInfo的json字符前面加上"data: "后面加上‘\n\n’然后输出，然后强制缓冲输出，清除缓冲区，等待100毫秒，循环完成后程序终止
在程序最后新增一条记录到aiaccesslog
*/

/* 
Write a PHP API code in English.
Import the PHP file '../config.inc.php'.
The database connection address is 'DB_HOST', username is 'DB_USER', password is 'DB_PASSWORD', and the database name is 'DB_SCHEMA'.
Import the PHP file '../vendor/autoload.php'.
Use the package Orhanerday\OpenAi\OpenAi.
Instantiate the OpenAI class into the variable '$open_ai' with 'getenv('OPENAI_API_KEY')' as the parameter.
Call the 'chat' method of '$open_ai' with two parameters:
The first parameter is an array containing 'model' as 'gpt-3.5-turbo', 'messages' as an array with two elements. The first element has 'role' as 'system', 'content' as the value of variable '$prompt'. The second element has 'role' as 'user', 'content' as the value of '$qu', 'temperature' as 1.0, 'max_tokens' as 200, 'frequency_penalty' and 'presence_penalty' as 0, and 'stream' as true.
The second parameter is a function with two parameters '$curl_info' and '$data'. In the function, print out '$data' and immediately output and clear the cache, then return the length of '$data'.

写一段php的api代码
代码内的语言是英文
引入php文件../config.inc.php
数据库连接的地址是DB_HOST，用户名是DB_USER，密码是DB_PASSWORD，数据库名是DB_SCHEMA
引入php文件'../vendor/autoload.php'
使用Orhanerday\OpenAi\OpenAi;包
实例化open-ai到变量$open_ai，将getenv('OPENAI_API_KEY')作为参数传入
调用$open_ai的chat方法，有两个参数：
1. 第一个参数是数组，其中model是gpt-3.5-turbo，messages是含有两个元素的数组，第一个元素的role是system，content是$prompt变量的值，第二个元素的role是user，content是$qu的值，temperature是1.0，max_tokens是200，frequency_penalty和presence_penalty都是0，stream是true
2. 第二个参数是一个函数，函数有两个参数$curl_info和$data，函数内将$data打印出来，并且立即输出缓存并清空缓存，然后返回$data的长度
*/


// Include config file
require_once('../config.inc.php');

// Connect to database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);

// Check if bid parameter is set in GET request
if (!isset($_GET['bid'])) {
    die(json_encode(['status' => false]));
}

// Get bot ID from GET request
$botid = intval($_GET['bid']);

// Check if bot ID is valid
if ($botid <= 0) {
    die(json_encode(['status' => false]));
}

// Set the default value of $qu variable
$qu = isset($_GET['qu']) ? $_GET['qu'] : 'Hello.';

// Get prompt from aibots table
$query = "SELECT prompt FROM aibots WHERE id = $botid";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die(json_encode(['status' => false]));
}

$row = mysqli_fetch_assoc($result);
$prompt = $row['prompt'];

// Send stream header and disable caching
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// Check if aiaccesslog table exists, create it if not
$query = "CREATE TABLE IF NOT EXISTS aiaccesslog (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            botid INT UNSIGNED NOT NULL,
            timestamp INT UNSIGNED NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

mysqli_query($conn, $query);

// Get last access timestamp for bot
$query = "SELECT MAX(timestamp) as lasttime FROM aiaccesslog";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    $lastTime = 0;
} else {
    $row = mysqli_fetch_assoc($result);
    $lastTime = $row['lasttime'];
}

// Calculate time since last access and wait if necessary
$intv = time() - $lastTime;

if ($intv < 10) {
    $waitSec = 10 - $intv;
    $infoString = "Due to resource limitations, the bot can only be executed once every 10 seconds. A user executed the bot $intv seconds ago. Please wait $waitSec seconds.";
    
    $infoStringArray = explode(" ", $infoString);
    $sysInfo = [
        'choices' => [
            [
                'delta' => [
                    'content' => ''
                ]
            ]
        ]
    ];
    
    foreach ($infoStringArray as $word) {
        $sysInfo['choices'][0]['delta']['content'] = $word . ' ';
        echo "data: " . json_encode($sysInfo) . "\n\n";
        ob_flush();
        flush();
        usleep(100000);
    }
    
    die();
}

require_once '../vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;

// Instantiate OpenAI
$open_ai = new OpenAi(getenv('OPENAI_API_KEY'));

// Call chat method with arguments and callback function
$open_ai->chat([
  'model' => 'gpt-3.5-turbo',
  'messages' => [
    ['role' => 'system', 'content' => $prompt],
    ['role' => 'user', 'content' => $qu],
  ],
  'temperature' => 1.0,
  'max_tokens' => 200,
  'frequency_penalty' => 0,
  'presence_penalty' => 0,
  'stream' => true
], function($curl_info, $data) {
  // Print data and immediately flush and clear buffer
  echo $data;
  ob_flush();
  flush();
  return strlen($data);
});

// Insert new access log record
$query = "INSERT INTO aiaccesslog (botid, timestamp) VALUES ($botid, " . time() . ")";
mysqli_query($conn, $query);