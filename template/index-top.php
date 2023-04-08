<?php
/*
Write a PHP code for a website with the following requirements:

The website is in English.
The website name is AI Open Center and the domain is AIOpenCenter.com.
The code should be as concise as possible.
Do not include any content not mentioned in the requirements.
Styles should be written inline.
Use Bootstrap from https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js without the integrity parameter.
Use jQuery from https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js.
Use Google font Montserrat for all text.
The webpage should be responsive using Bootstrap.
When referring to the primary color, use the color code 007bff. When referring to the secondary color, use the color code 212529.
The center of the webpage should contain a Bootstrap-responsive div with padding of "150px 30px" and include three parts:
Text: "Create your unique GPT AI bots in seconds" in the primary color, centered horizontally, font size 36px, bolded, and with "GPT AI Bots" in the secondary color.
The next line should have the text "Make artificial intelligence accessible to everyone!" with a font size of 24px and centered horizontally.
A centered button with a heartbeat animation, rounded corners, primary color background, "15px 30px" padding, white text with font size 20px, and text "Create!" When clicked, the button should open a modal called "CreateModal" without any content.


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
页面中部bootstrap自适应，包含3个部分的一个div，padding属性是"150px 30px"，这三个部分是：
1. 文本“Create your unique GPT AI bots in seconds”，使用主要颜色，要横向居中，字体大小设置为36px，要粗体，其中“GPT AI Bots”这部分单独使用次要颜色
2. 接下来一行是文字“Make artificial intelligence accessible to everyone!"，字体大小设置为24px，要横向居中
3. 接下来是一个居中的按钮，这个按钮有以下内容：有心跳的动画，圆角，按钮使用主要颜色，padding属性是"15px 30px"，里面的文字是“Create！”，文字单独使用白色，字体大小设置为20px，当点击时打开一个叫做CreateModal的modal，这个modal没有内容。
*/
?>

<div class="container py-5">
    <div class="text-center">
        <h1 class="fw-bold" style="font-size: 36px;color: #007bff;">Create your unique <span style="color: #212529;">GPT AI bots</span> in seconds</h1>
        <p class="mt-3" style="font-size: 24px;">Make artificial intelligence accessible to everyone!</p>
        <button class="btn btn-primary rounded-pill mt-3 heartbeat-btn" style="padding: 15px 30px;font-size: 20px;" data-bs-toggle="modal" data-bs-target="#CreateModal">Create!</button>
    </div>
</div>

<style>
    .heartbeat-btn {
  animation: heartbeat 1.5s infinite;
}

@keyframes heartbeat {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.2);
  }
  100% {
    transform: scale(1);
  }
}

</style>