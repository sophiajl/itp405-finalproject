<?php
session_start();

require_once "connect.php";

if(is_null($_SESSION['logged_in'])){
    echo"not logged in";
}

if($_SESSION['logged_in']){
    echo"logged in";

}

if (is_null($_GET['wine_id'])) {
    exit("Sorry, you are not allowed to reach this page directly
          Please go back to <a href='home.php'> Home Page </a>");
}

$wine_id = $_GET['wine_id'];
$name = $_GET['name'];
$grape_id = $_GET['grape_id'];
$year = $_GET['year'];
$wine_type_id = $_GET['wine_type_id'];
$country_id = $_GET['country_id'];
$tasting_note = $_GET['tasting_note'];
$price = $_GET['price'];

// 2. Generate & Submit SQL.


$sql = "UPDATE wine_list
        SET name = '" . $name . "', grape_id = " . $grape_id . ", year = '" . $year . "', wine_type_id = " . $wine_type_id . ", country_id = " . $country_id . ", tasting_note = '" . $tasting_note . "', price = '" . $price . "'
        WHERE wine_id =" . $wine_id;



$results = mysqli_query($conn, $sql);
if (!$results) {
    exit("SQL Error: " . mysqli_error($conn));
}


?>



<html>


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

    td {
        padding: 5px;
        border: 1px solid #CCC;
    }



    #body{
        margin-top:20px;
        margin-right:40px;
        margin-left:40px;
        padding:20px;
        width:90%;
        height:300px;
        background-color:white;

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
                <a href="" class="navlink">Wine List</a>


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
                <a href="" class="navlink">Wine List</a>
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

    <div id="body">

        Wine has been successfully updated.
        <?php echo "<a href='wine_edit.php?wine_id=" . $wine_id . "'>Go back to edit page</a>";
        ?>
        <br>


    </div><!--body-->

</div> <!--close outercontainer-->
</body>
</html>