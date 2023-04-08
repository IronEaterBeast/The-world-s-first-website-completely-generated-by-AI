<?php
/* 
Write a PHP code for a website with the following requirements:

The website is in English.
The website name is AI Open Center, and the domain is AIOpenCenter.com.
The code should be as concise as possible.
Do not write anything that was not mentioned in the requirements.
Styles should be written directly in the elements.
Bootstrap should be included from https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js, without the integrity parameter.
JQuery should be included from https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js.
Use Google font Montserrat for all the text.
Use Bootstrap for a responsive layout.
The main color is #007bff, and the secondary color is #212529.
Create a Bootstrap-style top navigation bar with a logo and a link to the homepage on the left and links to Sign Up and Log In on the right. When these links are clicked, the following happens:
Clicking Sign Up opens a Bootstrap modal named SignupModal with no content.
Clicking Log In opens a Bootstrap modal named LoginModal with no content.


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
bootstrap风格的顶部导航栏，左边是预留了logo的到首页的链接，右边是Sign Up和Log In的链接，这两个链接点击后的效果如下：
点击Sign Up会使用bootstrap打开一个叫做SignupModal的modal，这个modal没有内容
点击Log In会使用bootstrap打开一个叫做LoginModal的modal，这个modal没有内容
*/

/* 
Bootstrap-style top navigation bar. If $_SESSION['user'] exists, display the user's email address and a link to log out on the right. The log out link accesses ./API/logoutAPI.php through AJAX. If the returned data is true, refresh the current page. If the returned data is not true, alert the error message. If $_SESSION['user'] does not exist, display links for Sign Up and Log In.

bootstrap风格的顶部导航栏，如果存在$_SESSION['user']，那么右边显示用户邮箱号和注销的链接，注销的链接通过ajax方式访问./API/logoutAPI.php，如果返回数据是true那么刷新当前页面，如果返回数据不是true，那么alert错误信息，如果不存在$_SESSION['user']，那么显示Sign Up和Log In的链接
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Open Center</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" integrity="...">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">AI Open Center</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo $_SESSION['user'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="logout()">Log Out</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#SignupModal">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#LoginModal">Log In</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        function logout() {
            $.ajax({
                url: './API/logoutAPI.php',
                type: 'POST',
                success: function(data) {
                    if (data === true) {
                        location.reload();
                    } else {
                        alert(data);
                    }
                },
                error: function() {
                    alert('An error occurred while trying to logout.');
                }
            });
        }
    </script>