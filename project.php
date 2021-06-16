<?php
    $msg= "";
    use PHPMailer\PHPMailer\PHPMailer;


if(isset($_POST['SUBMIT'])){
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";

    $con = mysqli_connect($servername, $username, $password);   
    $name= $con->real_escape_string($_POST['name']);
    $email=$con->real_escape_string($_POST['email']);

    if($name == "" || $email== ""){
        $msg= "please check your inputs";
    }
    else{
    $sql=$con->query(query: "SELECT `id` FROM `phpmyadmin`.`1830081_mainproject` WHERE `email`=`$email`");
        if($sql->num_rows>0){
            $msg= "EMAIL ALREADY EXISTS IN THE DATABASE";
        }
        else{
            // $token='qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
            // $token=str_shuffle($token);
            // $token=substr($token, start:0 ,lenght:10);

            $ddl=$con->query(query: "INSERT INTO `phpmyadmin`.`1830081_mainproject` (`Name`, `Email`, `IsEmailConformed`, `token`) VALUES ('$name', '$email', '0', 'xx');
            " );
    

        // include_once "PHPMailer/PHPMailer.php"
        
        // $mail= new PHPMailer();
        // $mail->setfrom(address:'hello@codingpassiveincome.com');
        // $mail->addAddress($email, $name);
        // $mail->Subject="please verify email";
        // $mail->isHTML(isHTML: true);
        // $mail->Body="
        //             PLEASE CLICK ON THE LINK BELOW:<br><br>
                    
        //             <a href='http://codingpassiveincome.com/PHPEmailConformation/confirm.php?email=$email&token=$token'>Click Here</a>
        //             ";

            $to = "$email";
            $subject = "please verify";

            $message = "<b>please verify</b>";
            $message .= "<h1>This is headline.</h1>";

            $header = "From:abc@somedomain.com \r\n";
            $header .= "Cc:afgh@somedomain.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $retval = mail ($to,$subject,$message,$header);
            if($retval == true){
            $msg="YOU HAVE BEEN REGESTRED PLEASE VERIFY";
                }
            else{
                $msg="SOMETHING WENT WRONG PLEASE TRY AGAIN";
            }
        }
    }
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WELCOME SIR/MAAM</title>
<link rel="stylesheet" href="project.css">
</head>
<body>
<div class="container">
    <h4>WELCOME TO PROJECT</h2>
    <p>this project is made by me for RT CAMP Recruitment.</p>
    <?php if($msg!= "") echo $msg. "<br><br>" 
    ?>
    <form action="project.php" method="post">
        <input type="text" name="name" id="name" placeholder="Enter your Name">
        <input type="email" name="email" id="email" placeholder="Ënter your Email">
        <input type="SUBMIT" name="SUBMIT" value="SUBMIT">
    </form>
</div>
<script scr="project.js"></script>
</body>
</html>