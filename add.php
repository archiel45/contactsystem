<?php
include "config.php";

if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
}
$type = "";
if(isset($_GET["type"])){
  $type = $_GET["type"];
}

$name = '';
$company = "";
$phone = "";
$email = "";
$id = 0;
if($type == 2){
    $id = $_GET["id"];

    $id = mysqli_real_escape_string($con,$id);
   
    if ($id != ""){
        $sql_query = "SELECT * FROM contacts WHERE id='".$id."' and user_id='".$_SESSION['user_id']."' LIMIT 1";
        $result = mysqli_query($con,$sql_query);
        if($result){
            $row = mysqli_fetch_array($result);
            $name = $row['name'];
            $company = $row['company'];
            $phone = $row['phone'];
            $email = $row['email'];
            if($row['name'] == "" || $row['name'] == null){
                header('Location: home.php');
            }
        }else{
            header('Location: home.php');
        }
    }

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
              
                $( "#form" ).submit(function( event ) {
                    event.preventDefault();


                        var email = $("#txt_email").val();
                        var phone = $("#txt_pwd").val();
                        var name = $("#txt_name").val();
                        var company = $("#txt_conpwd").val();
                        var url = "<?php echo $type;?>";
                        var id = "<?php echo $id;?>";

                        url = url == 1? "addContact.php": "editContact.php";

                        $.ajax({
                            url:url,
                            type:'post',
                            data:{email:email,phone:phone,name:name,company:company,phone:phone,id:id},
                            success:function(response){
                                var msg = "";
                                console.log(response);
                                if(response == 1){
                                    window.location = "home.php";
                                
                                }else{
                                    alert("Failed to save data");
                                }
                                console.log(msg);

                                $("#message").html(msg);
                            }
                        });
                });

          
            });
        </script>
    </head>
    <body>
        <div class="container" id="form_div">
            <form id="form">
            <div id="div_reg">
                <h1><?php echo $type == 1? "Add Contact": "Edit Contact"; ?></h1>
                <div id="message"></div>
               
                <div>
                    <label for="">Name</label> <span class="required" id="req-email"></span>
                    <input type="text" value="<?php echo $name; ?>" class="textbox" id="txt_name" name="txt_name"  required maxlength="32"/>
                </div>
                <div>
                    <label for="">Email Address</label> <span class="required" id="req-email"></span>
                    <input type="email" class="textbox" value="<?php echo $email; ?>"  id="txt_email" name="txt_email"  maxlength="32"/>
                </div>
                <div>
                    <label for="">Phone</label> <span class="required" id="req-password"></span>
                    <input type="text" class="textbox" value="<?php echo $phone; ?>" id="txt_pwd" name="txt_pwd"  />
                </div>
                <div>
                    <label for="">Company</label> <span class="required" id="confirm-password"></span>
                    <input type="text" value="<?php echo $company; ?>" class="textbox" id="txt_conpwd" name="txt_conpwd" />
                </div>
                <div>
                    <input type="submit" value="Submit" name="but_submit" id="but_submit" />
                </div>
               
            </div>
            </form>
        </div>
        
    </body>
</html>

