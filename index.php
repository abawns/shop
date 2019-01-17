<?php
session_start();
if(isset( $_SESSION["id"])){
    header("Location:index.php");
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام</title>
</head>
<body>
    <form action="index.php"method="get">
        <input type="text" name="name" id="name">
        <input type="text" name="family" id="family">
        <input type="text" name="code" id="code">
        <input type="text" name="tell" id="tell">
        <input type="text" name="pass" id="pass">
        <input type="text" name="pass2" id="pass2">
        <input type="submit" value="ثبت نام" name="login">
    </form>
    <?php 
    if(isset( $_GET['login'])){
        //set login
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name="samaneh";
        // Create connection
        @$conn = new mysqli($servername, $username, $password,$db_name);
        // Check connection
        $name=$_GET['name'];
        $family=$_GET['family'];
        $code=$_GET['code'];
        $tell=$_GET['tell'];
        $pass=$_GET['pass'];
        $pass2=$_GET['pass2'];
        if(($name ==""&&$family=="")&&($code==""&&$tell=="")&&($pass==""&&$pass2=='')){
            echo('فیلد ها خالی است');
        }else{
            //empty
            if($pass==$pass2){// PASSWORD==
                if ($conn->connect_error) {
                    //conn
                    die('خطا در اتصال دیتابیس');
                    }
                    $sql='SELECT * FROM `login`';
                    if (mysqli_query($conn,$sql)) {
                        $sql="SELECT * FROM `login` WHERE code='$code'";
                        if($result=mysqli_query($conn,$sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo 'رکورد وجود دارد';
                            }else{
                                $sql="INSERT INTO `login` (`id`, `name`, `family`, `code`, `tell`, `pass`) VALUES (NULL,'$name','$family','$code','$tell','$pass'); ";
                                if(mysqli_query($conn,$sql)){
                                    echo ('اطلاعات  با موفقیت ثبت شد');
                                    header("Location:login.php");
                                }else{
                                    echo ('خطا در ثبت اطلاعات');
                                }

                            }
                            
                        }else{
                            echo 'خطا در کویری'.mysqli_error($conn);
                        }
                       
                    } else {
                        $sql ="CREATE TABLE `samaneh`.`login` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(35) NOT NULL , `family` VARCHAR(35) NOT NULL , `code` VARCHAR(35) NOT NULL , `tell` VARCHAR(35) NOT NULL , `pass` VARCHAR(35) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB"; 
                        if (mysqli_query($conn,$sql)) {
                            echo "ایجاد شد جدول شما";
                        } else {
                            echo "ایجاد نشد " . mysqli_error($conn);
                        }
                        
                    }
                    // PASSWORD==
                    }else{
                        echo('کلمه عبور هم خوانی ندارد');
                        // PASSWORD==
                    }
                }
        //empty
    }else{
        echo('فیلد ها رو پر کنید');
        //set login
    }


    echo '<br/>';
    






    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="samaneh";
    // Create connection
    @$conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        die('خطا در اتصال دیتابیس');
        }
        $sql="SELECT * FROM `login`";
        if($result=mysqli_query($conn,$sql)){
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["family"]. "<br>";
                }
            } else {
                echo "0 results";
            }
        }else{
            echo 'خطا در کویری';
        }
        mysqli_close($conn);







    ?>
</body>
</html>