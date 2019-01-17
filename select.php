<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wellcome</title>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="abc";
    $conn = new mysqli($servername, $username, $password,$db_name);
    mysqli_set_charset($conn,"utf8");
        if(isset($_GET['id'])){
            $input=$_GET['id'];
            $users=mysqli_query($conn,"SELECT * FROM `users` WHERE id=$input");
            if($users->num_rows>0){
                $result=mysqli_fetch_object($users);
                echo $result->name;
            }else{
                echo ("<br/>"."هیچ رکوردی پیدا نشد"."<br/>");
            }

            echo "sina";

        }
    ?>
</body>
</html>