
<?php


if (is_null($_GET['wine_id'])) {
    if (is_null($_GET['wine_id'])) {
        exit("Sorry, you are not allowed to reach this page directly
          Please go back to <a href='home.php'> Home Page </a>");
    }
}

$wine_id = $_GET['wine_id'];

require_once "connect.php";


$sql = "DELETE FROM wine_list
				WHERE wine_id = " . $wine_id;


$results = mysqli_query($conn, $sql);
if (!$results) {
    exit("Delete SQL Error: " . mysqli_error($conn));
}
?>



<html>
<head>
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
        background-color:#68000D;
        margin:auto;
        position:absolute;
        padding-top:10px;
        height:1200px;

    }

    .navlink {
        float:left;
        display: block;
        width: 150px;
        height: 40px;
        margin-top: 25px;
        color:white;
        font-size: 30px;
        text-align: center;
        text-decoration: none;

    }

    .navlink:hover {
        color:#F4DBD8;
        text-decoration:underline;
    }
    #body{
        margin:auto;
        padding-top:20px;
        padding-bottom:20px;
        padding-left:150px;
        padding-right:150px;
    }


    #text{
        color:white;
        text-decoration:none;
    }

    #text:hover{
        text-decoration:underline;
    }
</style>


<body style="background-color:#FFFACC">

<div id="outercontainer">



    <?php
    if ( is_null($_SESSION['logged_in']) ) {
        ?>
        <div style="position:relative;padding-left:30px;padding-right:30px;">
            <a href="home.php" id="name"> Vinosaurus </a>
            <div style="margin:auto;">
                <a href="about.php" class="navlink">About Us</a>



                <a href="sign_up.php" class="navlink"
                   style="float:right;font-size:20px;margin-top:35px;margin-left:20px;width:80px;">Sign Up</a>
                <span style="color:white; font-size:15px;float:right;margin-top:40px;">or</span>
                <a href="login.php" class="navlink" style="float:right;font-size:20px;margin-top:35px;width:100px;">Log-in</a>
                <br style="clear:both;">
            </div>
        </div>
        <?php
    }
    else if($_SESSION['logged_in']){
        ?>
        <div style="position:relative;padding-left:30px;padding-right:30px;">
            <a href="home.php" id="name"> Vinosaurus </a>
            <div style="margin:auto;">
                <a href="about.php" class="navlink">About Us</a>
                <a href="wine_add.php" class="navlink">Add a Wine</a>
                <a href="logout.php" class="navlink" style="float:right;font-size:20px;margin-top:35px;margin-left:30px;width:100px;">Log-out</a>
                <div style="color:white;float:right;font-size:20px;margin-top:35px;margin-left:20px;width:200px;">
                    Welcome,
                    <?php echo $_SESSION['username']; ?>
                </div>


                <br style="clear:both;">
            </div>
        </div>
        <?php
    }
    ?>

    <img src="winerack.jpg" style="width:100%;opacity:0.8;">

    <div id="body">
        <div style="float:left;text-align:center;center;font-size:30px; color:white;font-weight:bold;">

            Wine was successfully deleted.
            <br>


            <hr>

            <hr>
        </div><!--close intro-->
    </div><!--close body-->
</div> <!--close outercontainer-->


</body>
</html>



