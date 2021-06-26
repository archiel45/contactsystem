<?php 
include "config.php";

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){
    echo $_SESSION['user_id'];
    var_dump($_SESSION['user_id']);
    header('Location: home.php');
}

?>
<!doctype html>
<html>
    <head>
        <title>Contact System</title>
        <link href="style.css" rel="stylesheet" type="text/css">

        <script src="jquery-3.2.1.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $("#req-email").text('');
                $("#req-password").text('');
               
                $("#but_submit").click(function(){
                    var email = $("#txt_email").val();
                    var password = $("#txt_pwd").val();

                    if( email != "" && password != "" ){
                        $("#req-email").text('');
                        $("#req-password").text('');
                        $.ajax({
                            url:'checkUser.php',
                            type:'post',
                            data:{email:email,password:password},
                            success:function(response){
                                var msg = "";
                                if(response == 1){
                                    window.location = "home.php";
                                }else{
                                    msg = "Invalid email and password!";
                                }
                                $("#message").html(msg);
                            }
                        });
                    }else{
                        if(email == ""){
                            $("#req-email").text(' ( Email must not be empty )');
                        }else{
                            $("#req-email").text('');
                        }
                        if(password == ""){
                            $("#req-password").text(' ( Password must not be empty )');
                        }else{
                            $("#req-password").text('');
                        }
                    }
                });

            });
        </script>
    </head>
    <body>
        <div class="container">
            <form id="form">
            <div id="div_login">
                <h1>Sign In</h1>
                <div id="message"></div>
                <div>
                    <label for="">Email Address</label> <span class="required" id="req-email"></span>
                    <input type="email" class="textbox" id="txt_email" name="txt_email"  required/>
                </div>
                <div>
                    <label for="">Password</label> <span class="required" id="req-password"></span>
                    <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" required/>
                </div>
                <div>
                    <input type="button" value="Submit" name="but_submit" id="but_submit" />
                    
                </div>
                <div style="float:right">
                    <a href="register.php">Register User</a>
                </div>
            </div>
            </form>
        </div>
    </body>
</html>

