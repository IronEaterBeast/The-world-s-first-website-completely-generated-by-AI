<?php
/*
Write a piece of PHP code for a website with the following requirements:

The page should be in English
The website name is AI Open Center and the domain name is AIOpenCenter.com
The code should be as concise as possible
Do not write any content that is not mentioned
Styles should be directly written in the elements
Bootstrap is included from https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js without the integrity parameter
jQuery is included from https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js
All fonts should use the Google font Montserrat
The page should use Bootstrap for responsiveness
When referring to the primary color, use the color code 007bff, and when referring to the secondary color, use the color code 212529
Create a responsive div with a light gray background that contains a search box with the following specifications:
ID is botsearch
Horizontally centered
The search box should have the placeholder text "poem writer"
There should be no search button
The search box should have a distance of 30px from the top and bottom

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
建立一个自适应的div，底色是浅灰色，里面有一个搜索框，这个搜索框要：id是botsearch，横向居中，搜索框提示输入的文字是“poem writer”，搜索框没有search按钮，搜索框和上下的距离是30px
*/

/* 
When the content of the input with the id 'botsearch' changes and waits for 1 second, send the content as the 'botsearch' parameter using the GET method to './API/botsearchAPI.php'.
Receive the return value from './API/botsearchAPI.php', loop through the value and use a card with a height of 200px. In the top center of the card, display a div with a gray background that is 80px in height and width, and has a centered 🤖 with a size of 2rem. Display the 'name' in the center of the card title, and display the 'description' in the center of the card text. At the bottom of the card, display a div with the class 'w-100' that shows a link with the text 'run' and a link address of './bot.php?id='. The link class should also have 'w-100'. Then, display these cards in a row with the id 'botresults'.
When the page finishes loading, trigger the content change event of the input with the id 'botsearch'.

当id是botsearch的input的内容发生改变并等待了1秒的时候，将内容作为get方法的botsearch参数发送给./API/botsearchAPI.php
接收./API/botsearchAPI.php的返回值，将返回值循环，使用一个高度为200px的card，在card的顶部居中显示一个div，背景是高度宽度都是80px的圆形浅灰色，里面居中显示大小是2rem的🤖，将其中的name居中显示到card的card-title，将description居中显示到card的card-text里，在card的下部显示一个div，这个div的类要有w-100，里面显示一个文字是run的链接地址是./bot.php?id=，这个链接类要有w-100，然后将这些card显示到id等于botresults的row中
在页面刚打开完毕的时候，触发id是botsearch的input的内容发生改变事件
*/
?>

<div class="container-fluid bg-light">
    <div class="row justify-content-center" style="padding-top: 30px; padding-bottom: 30px;">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <input type="text" id='botsearch' class="form-control text-center" placeholder="poem writer" style="font-family: 'Montserrat', sans-serif;">
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#botsearch').on('input', function() {
            clearTimeout($.data(this, 'timer'));
            var search_term = $(this).val();
            $('#botresults').empty();
            $(this).data('timer', setTimeout(function() {
                $.get('./API/botsearchAPI.php', {
                    botsearch: search_term
                }, function(data) {
                    var results = JSON.parse(data);
                    $('#botresults').empty();
                    for (var i = 0; i < results.length; i++) {
                        var card = $('<div>').addClass('col-md-4 mb-4').append(
                            $('<div>').addClass('card h-100').append(
                                $('<div>').addClass('card-body d-flex flex-column justify-content-center align-items-center').append(
                                    $('<div>').addClass('bg-light rounded-circle d-flex justify-content-center align-items-center').css('width', '80px').css('height', '80px').append(
                                        $('<span>').addClass('text-primary').css('font-size', '2rem').text('🤖')
                                    ),
                                    $('<h5>').addClass('card-title text-center mt-3').text(results[i].name),
                                    $('<p>').addClass('card-text text-center').text(results[i].description),
                                    $('<div>').addClass('mt-auto  w-100').append(
                                        $('<a>').addClass('btn btn-primary w-100').attr('href', './bot.php?id=' + results[i].id).text('Run')
                                    )
                                )
                            )
                        );

                        $('#botresults').append(card);
                    }
                });
            }, 1000));
        });
        $('#botsearch').trigger('input');
    });
</script>