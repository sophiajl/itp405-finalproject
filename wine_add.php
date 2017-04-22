<?php
session_start();

require_once "connect.php";



// 2. Generate & Submit SQL.

$sql_grapes = "SELECT * FROM grapes";
$sql_wine_types = "SELECT * FROM wine_types";
$sql_countries = "SELECT * FROM countries";

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
    exit("Types SQL Error: " . mysqli_error($conn));
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
    #labels{
        float:left;
        margin-right:30px;
    }
    #values{

    }
    .button{
        margin-top:10px;
        width:100px;
        font-size:15px;
        color: #68000D;
        background: white;
        font-weight: bold;
        border: 1px solid #68000D;
    }

    .button:hover {
        color: white;
        background: #68000D;
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



        <div id="form">
            <div id="labels">
                Wine Name:
                <br/>
                Grape:
                <br/>
                Year Bottled:
                <br/>
                Wine Type:
                <br/>
                Country:
                <br/>
                Price:
                <br/>
            </div> <!--close labels-->
            <div id="values">
                <form method="get" action="wine_add_table.php">
                    <input style="width:300px;font-size:15px;font-family:times;" type="text" name="name">
                    <br/>
                    <select style="font-size:15px;font-family:times;width:200px;" name="grape_id">

                        <?php
                        while ($row = mysqli_fetch_array($results_grapes)){
                            echo "<option value='" . $row['grape_id'] . "'>";
                            echo $row['grape'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <br/>
                    <input  style="font-size:15px;font-family:times;width:200px;" type ="text" name="year">
                    <br/>
                    <select style="font-size:15px;font-family:times;width:200px;" name="wine_type_id">

                        <?php
                        while ($row = mysqli_fetch_array($results_wine_types)){
                            echo "<option value='" . $row['wine_type_id'] . "'>";
                            echo $row['wine_type'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <br/>
                    <select style="font-size:15px;font-family:times;width:200px;" name="country_id">

                        <?php
                        while ($row = mysqli_fetch_array($results_countries)){
                            echo "<option value='" . $row['country_id'] . "'>";
                            echo $row['country'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <br/>
                    <input style="font-size:15px;font-family:times;width:250px;" name="price">
                    <br/>

                    <button class="button" type="submit" value="Submit"/>Submit</button>

                </form>
    <hr>


</div> <!--close outercontainer-->
</body>
</html>