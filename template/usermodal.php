<?php
/*
1. A bootstrap modal with an ID of SignupModal, which displays a title saying 'Welcome! Let's create your account', followed by a registration form for email and password. To the right of the submit button is an 'Log In' anchor element. Clicking on this element opens a bootstrap modal with an ID of LoginModal.
2. A bootstrap modal with an ID of LoginModal, which displays a title saying 'Welcome back! Log in to your account', followed by a login form for email and password. To the right of the submit button is a 'Create your account' anchor element. Clicking on this element opens a bootstrap modal with an ID of SignupModal.

1. 一个id叫做SignupModal的bootstrap的modal，modal的标题显示“Welcome! Let's create your account”，下面是邮箱和密码的注册表单，在提交按钮的右边，有“Log In”的a元素，点击这个a元素，这个a元素靠右，打开一个id叫做LoginModal的bootstrap的modal 
2. 一个id叫做LoginModal的bootstrap的modal，modal的标题显示“Welcome back! Log in to your account”，下面是邮箱和密码的登录表单，在提交按钮的右边，有“Create your account”的a元素，这个a元素靠右，点击这个a元素，打开一个id叫做SignupModal的bootstrap的modal
*/

/* 
Add AJAX registration functionality to ChatGPT's commands:
Create a Bootstrap modal with an id of 'LoginSuccess'. The modal should contain a div with an id of 'loginsuccessmsg' for displaying success messages and a button for refreshing the current page upon clicking.
Create another Bootstrap modal with an id of 'SignupModal'. This modal should include a registration form for email and password. When the form is submitted, prevent the form's default submission behavior and use AJAX to submit the data to './API/signupAPI.php'. Upon receiving a response, perform the following actions:
If the response is 'true', display the 'LoginSuccess' modal and show the English message 'Registration successful. You will be automatically logged in after 5 seconds.' in the 'loginsuccessmsg' div. Then, refresh the page after 5 seconds.
If the response is not 'true', display the response data as an error message in the 'signuperrormsg' div.

添加ajax注册的功能，给ChatGPT的命令：
写一个id叫做LoginSuccess的bootstrap的modal，中间有一个用于显示成功信息的id=loginsuccessmsg的div，下面有点击后立刻刷新当前页面的按钮
写一个id叫做SignupModal的bootstrap的modal，modal包含邮箱和密码的注册表单，点击提交以后，阻止表单本身的提交，使用ajax将数据提交到./API/signupAPI.php，当接受到返回数据以后，做下面的操作： 
如果返回数据是true，那么显示id叫做LoginSuccess的modal，在id=loginsuccessmsg的div中显示"注册成功，将在5秒后自动登录"的英文，然后在5秒以后刷新页面
如果返回的数据不是true，那么将数据作为错误信息，显示在id=signuperrormsg的div中
*/

/* 
Add AJAX login functionality for ChatGPT with the following commands:

Create a Bootstrap modal with id 'LoginSuccess', containing a 'loginsuccessmsg' div for displaying a success message and a button to refresh the current page upon clicking.
Create a Bootstrap modal with id 'LoginModal', containing a login form for email and password. Upon clicking 'submit', prevent the form from submitting and use AJAX to submit the data to './API/loginAPI.php'. Upon receiving a response, perform the following actions:
If the response is 'true', display the 'LoginSuccess' modal, show the message 'Login successful, you will be automatically logged in after 3 seconds' in the 'loginsuccessmsg' div, and refresh the page after 3 seconds.
If the response is not 'true', display the response data as an error message in the 'loginerrormsg' div with id 'loginerrormsg'.

添加ajax登录的功能，给ChatGPT的命令：
写一个id叫做LoginSuccess的bootstrap的modal，中间有一个用于显示成功信息的id=loginsuccessmsg的div，下面有点击后立刻刷新当前页面的按钮
写一个id叫做LoginModal的bootstrap的modal，modal包含邮箱和密码的登录表单，点击提交以后，阻止表单本身的提交，使用ajax将数据提交到./API/loginAPI.php，当接受到返回数据以后，做下面的操作： 
如果返回数据是true，那么显示id叫做LoginSuccess的modal，在id=loginsuccessmsg的div中显示"登录成功，将在3秒后自动登录"的英文，然后在3秒以后刷新页面
如果返回的数据不是true，那么将数据作为错误信息，显示在id=loginerrormsg的div中
*/
?>

<!-- Sign up modal -->
<div class="modal fade" id="SignupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Welcome! Let's create your account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="SignupForm">
                    <div id="signuperrormsg" class="alert alert-danger d-none"></div>
                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="signupEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupPassword" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="signupPassword" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="signup()">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <span>Already have an account?&nbsp;</span>
                <a href="#" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#LoginModal">Log in</a>
            </div>
        </div>
    </div>
</div>

<!-- Log in modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Welcome back! Log in to your account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="LoginForm">
                    <div id="loginerrormsg" class="alert alert-danger d-none"></div>
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="emailInput">
                    </div>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="passwordInput">
                    </div>
                    <div class="text-end">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#SignupModal">Create your account</a>
                        <button type="submit" class="btn btn-primary ms-2">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Login Success Modal -->
<div class="modal fade" id="LoginSuccess" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loginsuccessmsg" class="text-center">logged in after 5 seconds.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="location.reload();">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    function signup() {
        $('#signuperrormsg').addClass('d-none');
        $.ajax({
            url: './API/signupAPI.php',
            type: 'POST',
            data: $('#SignupForm').serialize(),
            success: function(data) {
                if (data == 'true') {
                    $('#loginsuccessmsg').html('Registration successful. You will be automatically logged in after 5 seconds.');
                    $('#SignupModal').modal('hide');
                    $('#LoginSuccess').modal('show');
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                } else {
                    $('#signuperrormsg').html(data);
                    $('#signuperrormsg').removeClass('d-none');
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('#LoginForm').submit(function(e) {
            $('#loginerrormsg').addClass('d-none');
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './API/loginAPI.php',
                data: $('#LoginForm').serialize(),
                success: function(data) {
                    if (data == 'true') {
                        $('#loginsuccessmsg').html('Login successful. You will be logged in after 3 seconds.');
                        $('#LoginModal').modal('hide');
                        $('#LoginSuccess').modal('show');
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        $('#loginerrormsg').html(data);
                        $('#loginerrormsg').removeClass('d-none');
                    }
                },
                error: function() {
                    $('#loginerrormsg').html('An error occurred while logging in. Please try again later.');
                    $('#loginerrormsg').removeClass('d-none');
                }
            });
        });
    });
</script>