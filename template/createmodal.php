<?php
/* 
Create a bootstrap modal with an ID of CreateModal for creating a custom AI bot, with all language in English. The modal should contain a form with the following elements:

A div with a light gray circular background, centered with a 🤖 emoji
A div with an ID of CreateErrorMsg, initially hidden with the class d-none, for displaying error messages
A required single-line text input for the user to input the bot's name, with a prompt inside saying 'AI Python assistant bot'
A required multi-line text input for the user to input the bot's description, with a prompt inside saying 'This bot can help you write Python example programs'
A required multi-line text input for the user to input the prompt, with a prompt inside saying 'You are an AI bot that generates example programs based on user requests'
A required single-line text input for the user to input the example command, with a prompt inside saying 'Calculate a set of numbers and sort them in descending order'
On form submission, the CreateErrorMsg div should be hidden with the d-none class, and the form submission should be prevented. The form data should be submitted to './API/createBotAPI.php' using AJAX. Upon receiving a response, the following actions should be taken:

If the response is 'true', a Bootstrap success message should be displayed with the English text 'Created successfully. Redirecting to AI bot in 5 seconds...', followed by a countdown timer for five seconds and then a redirect to './bot.php?id='.
If the response is not 'true', the returned data should be displayed in the CreateErrorMsg div, and the d-none class should be removed.

写一个id叫做CreateModal的bootstrap的modal，用于创建一个自定制的ai bot
所有语言为英语
这个modal含有一个表单，这个表单有如下内容：
一个div，背景圆形浅灰色，里面居中显示🤖
一个用于显示错误信息的div，id是CreateErrorMsg，属于类d-none
一个输入机器人名字的必填的单行文本框，里面提示ai python辅助机器人
一个用户输入机器人描述的必填的多行文本框，里面提示这个机器人可以帮助你写出python例子程序
一个用于输入Prompt的必填的多行文本框，里面提示你是一个根据用户需求生成相应例子程序的ai机器人
一个用于输入例子命令的必填的单行文本框，里面提示计算一组数字从大到小排序
点击提交以后，将id是CreateErrorMsg的div添加d-none类，阻止表单本身的提交，使用ajax将数据提交到./API/createBotAPI.php，当接受到返回数据以后，做下面的操作：
如果返回数据是true，那么弹出bootstrap成功消息框，显示“创建成功，5秒后跳转到ai bot”的英语，并且倒计时五秒跳转到"./bot.php?id="
如果返回的数据不是true，那么在id是CreateErrorMsg的div中显示返回的数据，同时移除d-none这个类
*/
?>

<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="CreateBotForm">
        <div class="modal-header">
          <h5 class="modal-title" id="CreateModalLabel">Create AI Bot</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div style="background-color: #f2f2f2; border-radius: 50%; width: 100px; height: 100px; margin: 0 auto; display: flex; justify-content: center; align-items: center; margin-bottom: 0px;">
            <span style="font-size: 3rem;">🤖</span>
          </div>
          <div class="mb-3">
            <label for="inputName" class="form-label">AI Bot Name</label>
            <input name="name" type="text" class="form-control" id="inputName" placeholder="AI Python Assistant Bot" required>
          </div>
          <div class="mb-3">
            <label for="inputDescription" class="form-label">Bot Description</label>
            <textarea name="description" class="form-control" id="inputDescription" rows="2" placeholder="This bot can help you write Python example programs" required></textarea>
          </div>
          <div class="mb-3">
            <label for="inputPrompt" class="form-label">Bot Prompt</label>
            <textarea name="prompt" class="form-control" id="inputPrompt" rows="2" placeholder="You are an AI robot that generates corresponding example programs based on user needs." required></textarea>
          </div>
          <div class="mb-3">
            <label for="inputExample" class="form-label">Example Command</label>
            <textarea name="example" class="form-control" id="inputExample" rows="2" placeholder="Calculate a list of numbers and sort them in descending order" required></textarea>
          </div>
          <div id="CreateErrorMsg" class="alert alert-danger d-none"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="create()">Create Bot</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="CreateSuccessModal" tabindex="-1" aria-labelledby="CreateSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateSuccessModalLabel">Bot Created Successfully!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Your custom AI bot has been created successfully. You will be automatically redirected to it after 5 seconds.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  function create() {
    // Hide error message div
    $('#CreateErrorMsg').addClass('d-none');
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: "./API/createBotAPI.php",
      data: $("#CreateBotForm").serialize(),
      success: function(response) {
        var response= JSON.parse(response);
        if (response[0] === "true") {
          $("#CreateModal").modal("hide");
          $("#CreateSuccessModal").modal("show");
          var countDown = 5;
          var intervalId = setInterval(function() {
            if (countDown <= 0) {
              clearInterval(intervalId);
              window.location.href = "./bot.php?id="+response[1];
            } else {
              countDown--;
            }
          }, 1000);
        } else {
          $('#CreateErrorMsg').html(response[1]);
          $('#CreateErrorMsg').removeClass('d-none');
        }
      },
      error: function() {
        $("#CreateErrorMsg").html("An unknown error occurred.");
        $('#CreateErrorMsg').removeClass('d-none');
      }
    });
  }
</script>