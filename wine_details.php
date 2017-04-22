<?php
session_start();

require_once "connect.php";

if (is_null($_GET['wine_id'])) {
    exit("Sorry, you are not allowed to reach this page directly
          Please go back to <a href='home.php'> Home Page </a>");
}




$wine_id = $_GET['wine_id'];


// 2. Generate & Submit SQL.
$sql = "SELECT *
        FROM wine_list, grapes, wine_types, countries
			WHERE wine_list.grape_id = grapes.grape_id 
				AND wine_list.wine_type_id = wine_types.wine_type_id
                AND wine_list.country_id = countries.country_id
                AND wine_id = " . $wine_id;

$results = mysqli_query($conn, $sql);
if (!results){
    exit('SQL Error: ' . mysqli_error($conn));
}

//3. Display data
$row = mysqli_fetch_array($results);
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



<table style= "float:left;font-size:20px;">
    <tr>
        <td><strong>Wine Name:</strong></td>
        <td><?php echo $row['name']; ?></td>
    </tr>
    <tr>
        <td><strong>Grape:</strong></td>
        <td><?php echo $row['grape']; ?></td>
    </tr>
    <tr>
        <td><strong>Year:</strong></td>
        <td><?php echo $row['year']; ?></td>
    </tr>
    <tr>
        <td><strong>Wine Type:</strong></td>
        <td><?php echo $row['wine_type']; ?></td>
    </tr>
    <tr>
        <td><strong>Country:</strong></td>
        <td><?php echo $row['country']; ?></td>
    </tr>
    <tr>
        <td><strong>Tasting Notes:</strong></td>
        <td><?php echo $row['tasting_note']; ?></td>
    </tr>
    <tr>
        <td><strong>Price</strong></td>
        <td><?php echo $row['price']; ?></td>
    </tr>
</table>


   <?php if($_SESSION['logged_in']) {


    echo "<a href='wine_edit.php?wine_id=" . $row['wine_id'] . "'>"; ?>

    <div id="button">Edit</div>
<?php }; ?>

</div><!--close body-->

</div> <!--close outercontainer-->
</body>
</html>