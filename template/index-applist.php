<?php
/*
Write a PHP code for a website with the following requirements:

The website is in English.
The website name is AI Open Center and the domain is AIOpenCenter.com.
The code should be as concise as possible and not include any unnecessary content.
Styles should be included directly in the elements.
Use https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js for Bootstrap without integrity parameters.
Use https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js for jQuery.
Use Montserrat from Google Fonts for all text.
Use Bootstrap for responsive design.
When referring to the primary color, use the color code 007bff. When referring to the secondary color, use the color code 212529.
Create an adaptive div with a light grey background color. The div should display small search result cards with the ID 'botresults'. On a PC, 4 small cards should be displayed per row. As the window size decreases, the number of small cards per row should automatically adjust to 3, 2, and then 1.

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
建立一个自适应的div，底色是浅灰色，div里面显示搜索结果小卡片，其中row的id是botresults，pc上一行显示4个小卡片，随着窗口变小，自动调整每行显示数量为3个小卡片，2个小卡片，1个小卡片
*/
?>

<div class="container-fluid bg-light py-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="botresults">
        <div class="col">
            <div class="card">
                <h5 class="card-title">Search Result 1</h5>
                <p class="card-text">This is a sample text for search result 1.</p>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <h5 class="card-title">Search Result 2</h5>
                <p class="card-text">This is a sample text for search result 2.</p>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <h5 class="card-title">Search Result 3</h5>
                <p class="card-text">This is a sample text for search result 3.</p>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <h5 class="card-title">Search Result 4</h5>
                <p class="card-text">This is a sample text for search result 4.</p>
            </div>
        </div>
    </div>
</div>