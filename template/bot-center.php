<?php
/* 
Write a PHP code for a website that meets the following requirements:

The website should be in English
The website name is AI Open Center, and the domain name is AIOpenCenter.com
Keep the code concise
Do not include any unnecessary elements
Style elements directly with inline styles
Bootstrap should be included from https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js, without the integrity parameter
jQuery should be included from https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js
Use Google Font Montserrat for all fonts
The page should be responsive with Bootstrap
The primary color is #007bff and the secondary color is #212529
The page should include the following, all styled with Bootstrap:
A horizontally centered div with a light gray circular background, 200px height and width, and an 80px centered 🤖 icon.
A centered title displaying the PHP variable $botname
A subtitle displaying the PHP variable $botdescription
A form with two elements:
A multiline text input box centered horizontally, with a placeholder text of "Ask me anything" in English, and the content from the PHP variable $example
A submit button aligned to the right with an ID of runbotbtn
A centered title "Result"
A card element to display the multiple lines of text with an ID of message.

写一段网站的php代码，要求：
页面是英文的
网站名字是AI Open Center，域名是AIOpenCenter.com
代码尽量精简
不要编写没有提到的内容
样式直接写到元素里面
引入bootstrap是https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js，不要有integrity参数
引入jquery是https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js
所有字体使用谷歌字体的Montserrat
页面使用bootstrap来完成自适应
当说到主要颜色时是指颜色007bff，当说到次要颜色时是指颜色212529
这个页面包含一下内容，全部用bootstrap风格编写：
一个横向居中的div，背景圆形浅灰色，高度宽度200px，里面居中显示80px的🤖
显示一个居中标题，里面打印php变量$botname
显示一个副标题，里面打印php变量$botdescription
显示一个表单，里面有两个元素：
1、一个text多行输入框，这个输入框要横向居中，提示信息是英文的“问我点什么”，里面内容是php的变量$example
2、一个靠右的提交按钮，id是runbotbtn
显示一个居中的标题“Result”
显示一个用于放置多行文本内容的卡片，其中显示文本的元素id是message
*/

/* 
Write a PHP code.
The language used inside the code is English.
Include the PHP file ./config.inc.php.
The database connection address is DB_HOST, username is DB_USER, password is DB_PASSWORD, and database name is DB_SCHEMA.
Set the PHP variable $botname to "AI Open Center", set $botdescription to "Subtitle goes here", and set $example to "Who are you".
Check if the GET parameter 'id' exists. If it does not, set $botname to "Please provide the bot ID". If it does, convert it to an integer and assign it to the PHP variable $botid. Check if $botid is empty. If it is, set $botname to "Please provide a valid bot ID".
If $botid is not empty, fetch the row from the aibots table in the database where the id equals $botid. If this row exists, assign the value of the name column to the variable $botname, assign the value of the description column to the variable $botdescription, and assign the value of the example column to the variable $example. If this row does not exist, set $botname to "Bot not found".
The PHP code should prevent SQL injection attacks.

写一段php代码
代码内的语言是英文
引入php文件./config.inc.php
数据库连接的地址是DB_HOST，用户名是DB_USER，密码是DB_PASSWORD，数据库名是DB_SCHEMA
将php变量$botname置为“AI Open Center”，将php变量$botdescription置为“Subtitle goes here”，将php变量$example置为“Who are you”，
判断是否有GET传递的id参数，如果没有，将$botname置为“请提供bot的id”的英文；如果有，将它转换为整数赋给php变量$botid，判断$botid是否为空，如果为空将$botname置为“请提供正确的bot的id”的英文
如果$botid不为空，取出数据库中的aibots表中id等于$botid的行，如果这行存在，将name列的值赋给变量$botname，将description列的值赋给变量$botdescription，将example列的值赋给变量$example，如果这行不存在，将$botname置为“没有找到相应的bot”的英文
php代码需要防止SQL注入攻击
*/

/* 
When clicking the button with id=runbotbtn, call the JavaScript method runbot. The content of the JavaScript method runbot is as follows:
Set the button with id=runbotbtn to a waiting state.
Instantiate an EventSource to access the address ./API/runbotapi.php, with the name 'qu' for the GET parameter, which is the content of the textarea with id=inputQuestion, trimmed of leading and trailing whitespaces. If the current page has a $_GET['id'], pass it as the name 'bid' for the GET parameter as well.
Clear the text in the element with id='message'.
When the EventSource receives a message, check if it is the string '[DONE]'. If it is, close the EventSource, set the button with id=runbotbtn to a normal state, and exit. If it is not the string '[DONE]', convert the message to JSON and assign it to the variable 'msg'. Check if 'msg' is an object and not null; otherwise, close the EventSource, set the button with id=runbotbtn to a normal state, and exit. If neither of the above is true, append the content of 'msg.choices[0].delta.content' to the end of the element with id='message'.
If an error occurs with the EventSource, print the error in the console, close the EventSource, and set the button with id=runbotbtn to a normal state.

当点击id=runbotbtn的按钮时，调用js方法runbot
js方法runbot内容如下：
将id=runbotbtn的按钮置为等待状态
实例化一个EventSource，访问地址是./API/runbotapi.php，将id是inputQuestion的textarea的内容去除前后空格以后作为名字叫qu的get参数，当前页面的$_GET['id']如果存在，将$_GET['id']作为名字叫bid的get参数一起传递
将id是“message”的元素里面的文字清空
当EventSource有消息传递的时候，判断是不是字符串“[DONE]”，如果是，关闭EventSource，将id=runbotbtn的按钮置为正常状态，然后退出；如果不是字符串“[DONE]”，那么将消息转换成json数据赋值给msg，判断msg是一个对象并且不等于null，否则关闭EventSource，将id=runbotbtn的按钮置为正常状态，然后退出；如果前面都不是，那么将msg.choices[0].delta.content添加在id是“message”的元素的最后
如果eventSource出现错误，那么在控制台打印错误，并且关闭EventSource，将id=runbotbtn的按钮置为正常状态
*/
?>

<?php
// Include config file
require_once './config.inc.php';

// Set database connection variables
$dbhost = DB_HOST;
$dbuser = DB_USER;
$dbpass = DB_PASSWORD;
$dbschema = DB_SCHEMA;

// Connect to the database
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbschema);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set bot name and description
$botname = "AI Open Center";
$botdescription = "Subtitle goes here";
$example = "Who are you";

// Check if ID parameter is provided
if (isset($_GET['id'])) {
    // Sanitize ID parameter to prevent SQL injection attacks
    $botid = mysqli_real_escape_string($conn, intval($_GET['id']));

    // Check if bot ID is empty
    if (empty($botid)) {
        $botname = "Please provide a valid bot ID";
    } else {
        // Query the database for bot with specified ID
        $sql = "SELECT name, description, example FROM aibots WHERE id = $botid";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Bot with specified ID found
            $row = mysqli_fetch_assoc($result);
            $botname = $row['name'];
            $botdescription = $row['description'];
            $example = $row['example'];

        } else {
            // Bot with specified ID not found
            $botname = "Bot not found";
        }
    }
} else {
    $botname = "Please provide a bot ID";
}

// Close the database connection
mysqli_close($conn);
?>


<div style="background-color: #f2f2f2; border-radius: 50%; width: 100px; height: 100px; margin: 20px auto; display: flex; justify-content: center; align-items: center; margin-bottom: 0px;">
    <span style="font-size: 3rem;">🤖</span>
</div>

<h2 class="text-center mt-4"><?php echo $botname; ?></h2>
<h4 class="text-center text-muted"><?php echo $botdescription; ?></h4>

<div class="container mt-5">
    <form class="col-md-8 mx-auto">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Ask me anything" id="inputQuestion" style="height: 100px;"><?php echo $example; ?></textarea>
            <label for="inputQuestion">Ask me anything</label>
        </div>

        <div class="d-flex justify-content-end my-3">
            <button id="runbotbtn" onclick="runbot();" type="button" class="btn btn-primary">RUN</button>
        </div>
    </form>

    <h2 class="text-center mt-1">Result</h2>
    <div class="card bg-light mt-3 mb-5 col-md-8 mx-auto">
        <div class="card-body">
            <p id="message" class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consectetur vestibulum mauris vitae viverra. Sed eu elit elit. Praesent in quam in dolor commodo ultrices vel eu risus. Integer ultrices, metus ac gravida posuere, augue justo efficitur odio, id dignissim leo magna in metus. Sed posuere ligula nec sapien dictum luctus.</p>
        </div>
    </div>
</div>

<script>
    function runbot(event) {
        // clear message element
        $("#message").empty();
        $('#runbotbtn').addClass('disabled').text('Please wait...');

        const question = $('#inputQuestion').val().trim();
        var url = './API/runbotapi.php?qu=' + encodeURIComponent(question);
        const id = '<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>';
        if (id !== '') {
            url += '&bid=' + encodeURIComponent(id);
        }
        console.log(url);
        const eventSource = new EventSource(url);

        eventSource.onmessage = function(e) {
            console.log(e);
            if (e.data === "[DONE]") {
                eventSource.close();
                $('#runbotbtn').removeClass('disabled').text('Run');
                return;
            }
            var msg = JSON.parse(e.data);
            if (!msg || typeof msg !== "object") {
                eventSource.close();
                $('#runbotbtn').removeClass('disabled').text('Run');
                return;
            }
            // Append message to element
            $('#message').append(msg.choices[0].delta.content);
        };
        eventSource.onerror = function(e) {
            console.error(e);
            eventSource.close();
            $('#runbotbtn').removeClass('disabled').text('Run');
        };
    }
</script>
</script>