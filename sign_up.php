<html>
<head>
    <title>Wine Database</title>
</head>

<style>
    #name{
        float:left;
        font-size:60px;
        margin-right:40px;
        font-weight:bolder;
        color:white;
        text-decoration:none;
    }
    #outercontainer{
        width:100%;
        background-color:#68000D;
        margin:auto;
        position:absolute;
        padding-top:10px;
        height:500px;

    }
    #box{
        font-size:25px;
        line-height:2;
        padding:20px;
        width:300px;
        background-color:white;
        position:relative;
        margin-left:50px;
        margin-top:100px;
    }

</style>


<body style="background-color:#FFFACC">

<div id="outercontainer">

    <div style="position:relative;padding-left:30px;padding-right:30px;">
        <a href="home.php" id="name"> Vinosaurus </a>

    </div>

<div id="box">
    <?php

    // 1. Connect to DB.
    $host = 'uscitp.com';
    $user = 'sophiajl_dvduser';
    $pass = 'dvduser';
    $db = 'sophiajl_wine_db';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        exit("MySQL Connection Error: " . mysqli_connect_error());
    }


    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    if ( !empty($username) && !empty($email) && !empty($password) ) {

        $password = hash('SHA256', $password);

        $sql = "INSERT INTO users (username, email, password)
          VALUES ('$username', '$email', '$password')";

        $results = mysqli_query($conn, $sql);
        if(!$results){
            exit("INSERT SQL Error: " . mysqli_error($conn));
        }

        $subject = "Registration was successful.";

        $msg = "<h1>Hello:</h1>";
        $msg = $msg . "<strong>$username</strong> was successfully registered.";

        $header = "From: vinosaurusregistration@gmail.com";
        $header = $header . "\r\n";
        $header = $header . "Content-type: text/html";

        if (mail($email, $subject, $msg, $header) ){
            echo "Confirmation email sent. <br>";
        } else {
            echo "Email server error.<br>";
        }

        exit("$username was successfully created. <a href='profile.php'>Go to Dashboard.</a>");

    } else {
        echo "Please fill out all the fields.<br>";
    }

    ?>

    <form method="post" action="sign_up.php">
        Email: <input type="email" name="email"/>
        <br/>
        Username: <input type="text" name="username"/>
        <br/>
        Password: <input type="password" name="pass"/>
        <br/>
        <input type="submit" value="Signup"/>
    </form>


</div>

</div>