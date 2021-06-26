<?php 
include "config.php";

if(!isset($_SESSION['user_id'])){
    header('Location: home.php');
}

?>
<!doctype html>
<html>
    <head>
        <title>Contact System</title>
        <!-- <link href="style.css" rel="stylesheet" type="text/css"> -->

        <script src="jquery-3.2.1.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function(){
              
                $("#yes").click(function(){
                    $.ajax({
                            url:'deleteContact.php',
                            type:'post',
                            data:{id:"<?php echo $_GET["id"];?>"},
                            success:function(response){
                                var msg = "";
                                if(response == 1){
                                    window.location = "home.php";
                                }else{
alert('Failed to delete');                                }
                            }
                        });
                });
                $("#no").click(function(){
                    window.location = "home.php";

                });

            });
        </script>
    </head>
    <body>
        <div class="container">
            <form id="form">
            <div id="div_login">
                <h1>Delete Contact?</h1>
                <div>
                    <input type="button" value="Yes" name="yes" id="yes" />
                    <input type="button" value="No" name="no" id="no" />

                </div>
                
            </div>
            </form>
        </div>
    </body>
</html>

