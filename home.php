<?php 
include "config.php";

if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
}

?>
<!doctype html>
<html>
    <head>
        <title>Contact System</title>
        <link href="style.css" rel="stylesheet" type="text/css">

        <script src="jquery-3.2.1.min.js" type="text/javascript"></script>

        <script type="text/javascript">
                var countPage = 1;
            $(document).ready(function(){
               
                getContacts(page);
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

            function getContacts(page){

                $.ajax({
                    url:'getAllContacts.php',
                    type:'post',
                    data:{page:page},
                    dataType: "JSON",
                    success:function(response){
                        // response = SON.parse(response)
                       for(i in response){
                            data  =  response[i]

                            $("#contactTables tbody").append(
                                "<tr><td>"+data[1]+"</td>"+
                                "<td>"+data[2]+"</td>"+
                                "<td>"+data[3]+"</td>"+
                                "<td>"+data[4]+"</td>"+
                                '<td><a href="add.php?type=2&id='+data[0]+'">Edit</a> | <a href="delete.php?id='+data[0]+'">Delete</a></td><tr>'

                            );
                       }

                    }
                });
            }

            function countContacts(){
                $.ajax({
                    url:'countContacts.php',
                    type:'get',
                    dataType: "JSON",
                    success:function(response){
                        countPage = response > 10? response/10 : 1;
                        
                    }
                });
            }

        </script>
        <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    </head>
    <body>
    <h2>Contacts</h2>
    <div style="float: right;">
    <a href="add.php?type=1">Add</a> | Contacts
 | <a href="logout.php">Logout</a>
</div>
<br>
<div style="float: right;">
<input type="text" class="textbox" id="search" name="search"  placeholder="Search"/>
<br>

</div>
<br>
<div>
<table id= contactTables>
    <thead>
        <tr>
        <th>Name</th>
        <th>Company</th>
        <th>Phone</th>
        <th>Email</th>
        <th></th>
    </tr>
    </thead>
    <tbody></tbody>
  
</table>

</div>
<div id="pagination">

</div>

    </body>
</html>



