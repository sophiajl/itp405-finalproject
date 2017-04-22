<?php
session_start();

require_once "connect.php";


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
echo $wine_id;

$sql_grapes = "SELECT * FROM grapes
                WHERE grape_id =" . $grape_id;

$sql_wine_types = "SELECT * FROM wine_types
                    WHERE wine_type_id=" . $wine_type_id;

$sql_countries = "SELECT * FROM countries
                  WHERE country_id =" . $country_id;



$results_grapes = mysqli_query($conn, $sql_grapes);
if (!$results_grapes) {
    exit("Grapes SQL Error: " . mysqli_error($conn));
}

$results_wine_types = mysqli_query($conn, $sql_wine_types);
if (!$results_wine_types) {
    exit("Types SQL Error: " . mysqli_error($conn));
}

$results_countries = mysqli_query($conn, $sql_countries);
if (!$results_countries) {
    exit("Countries SQL Error: " . mysqli_error($conn));
}



//3. Display data

$row_grapes = mysqli_fetch_array($results_grapes);
$row_wine_types = mysqli_fetch_array($results_wine_types);
$row_countries = mysqli_fetch_array($results_countries);
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


    #form{
        background-color:white;
        color:black;
        text-align:left;
        margin-bottom:30px;
        margin-left:20%;
        padding-top:20px;
        padding-left:40px;
        font-size:20px;
        width:60%;
        height:400px;
        position:relative;
        line-height:2;
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

    #button{
        float:left;
        margin-left:20px;
        margin-top:5px;
        width:200px;
        height:20px;
        padding:5px;
        text-align:center;
        font-size:20px;
        border: 1px solid #68000D;
        text-decoration:none;
        color: #68000D;
        font-weight: bold;
        text-decoration:none;
    }
    #button:hover {
        background: #68000D;
        color: white;

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

        Please verify that the information you would like to update is correct.

        <br/><br/>
    <div id="table">
        <table style= "float:left;font-size:20px;">
            <tr>
                <td><strong>Wine Name:</strong></td>
                <td><?php echo "$name"; ?></td>
            </tr>
            <tr>
                <td><strong>Grape:</strong></td>
                <td><?php echo $row_grapes['grape']; ?></td>
            </tr>
            <tr>
                <td><strong>Year:</strong></td>
                <td><?php echo "$year"; ?></td>
            </tr>
            <tr>
                <td><strong>Wine Type:</strong></td>
                <td><?php echo $row_wine_types['wine_type']; ?></td>
            </tr>
            <tr>
                <td><strong>Country:</strong></td>
                <td><?php echo $row_countries['country']; ?></td>
            </tr>
            <tr>
                <td><strong>Tasting Notes:</strong></td>
                <td><?php echo "$tasting_note"; ?></td>
            </tr>
            <tr>
                <td><strong>Price</strong></td>
                <td><?php echo "$price"; ?></td>
            </tr>
        </table>

        <?php
        echo "<a href='wine_update.php?wine_id=" . $wine_id . "&name=" . $name . "&grape_id=" . $grape_id . "&year=" . $year . "&wine_type_id=" . $wine_type_id . "&country_id=" . $country_id . "&tasting_note=" . $tasting_note . "&price=" . $price ."'>"; ?>
        <div id="button">Update</div>

</div><!--close table-->
</div><!--body-->

</div> <!--close outercontainer-->
</body>
</html>