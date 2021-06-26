<?php
include "config.php";

 if(isset($_SESSION['user_id'])){
     echo $_SESSION['user_id'];
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
                $("#thankyou").hide();
                $("#req-email").text('');
                $("#req-password").text('');
               
                $( "#form" ).submit(function( event ) {
                    event.preventDefault();

                    var samepassword = false;

                    if($('#txt_pwd').val() == $('#txt_conpwd').val()){
                        samepassword = true;
                        $("#confirm-password").text('');
                    }else{
                        samepassword = false;
                        $("#confirm-password").text(' ( Passwords do not match )');
                    }
                
                    if(samepassword){

                        var email = $("#txt_email").val();
                        var password = $("#txt_pwd").val();
                        var name = $("#txt_name").val();

                        $.ajax({
                            url:'registerUser.php',
                            type:'post',
                            data:{email:email,password:password,name:name},
                            success:function(response){
                                var msg = "";
                                console.log(response);
                                if(response == 1){
                                    // window.location = "home.php";
                                    $("#form_div").hide();
                                    $("#thankyou").show();

                                }else if(response == 2){
                                    msg = "Email Address already exists";
                                }else{
                                    msg = "Failed to register user";
                                }
                                console.log(msg);

                                $("#message").html(msg);
                            }
                        });
                    }
                    
                });

                $("#continue").click(function(){
                    window.location = "home.php";
                });


            });
        </script>
    </head>
    <body>
        <div class="container" id="form_div">
            <form id="form">
            <div id="div_reg">
                <h1>Register</h1>
                <div id="message"></div>
                <div>
                    <label for="">Name</label> <span class="required" id="req-email"></span>
                    <input type="text" class="textbox" id="txt_name" name="txt_name"  required maxlength="32"/>
                </div>
                <div>
                    <label for="">Email Address</label> <span class="required" id="req-email"></span>
                    <input type="email" class="textbox" id="txt_email" name="txt_email"  required maxlength="32"/>
                </div>
                <div>
                    <label for="">Password</label> <span class="required" id="req-password"></span>
                    <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" required />
                </div>
                <div>
                    <label for="">Confirm Password</label> <span class="required" id="confirm-password"></span>
                    <input type="password" class="textbox" id="txt_conpwd" name="txt_conpwd" required/>
                </div>
                <div>
                    <input type="submit" value="Submit" name="but_submit" id="but_submit" />
                </div>
                <div style="float:right">
                    <a href="index.php">Login User</a>
                </div>
            </div>
            </form>
        </div>
        <div id="thankyou">
            <h1>Thank you for registering</h1>
            <button class="button" id="continue">Continue</button>
        </div>
    </body>
</html>

