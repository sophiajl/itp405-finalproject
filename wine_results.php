<?php

session_start();

require "connect.php";
?>

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
    #table{

        background-color:white;
        font-size:20px;
        padding-top:20px;
        padding-bottom:20px;
        padding-left:60px;
        margin-left:50px;
        margin-right:50px;
    }
    #page{
        margin-top:20px;
        margin-left:60px;

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
                <a href="wine_add.php" class="navlink">Wine List</a>
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

    <?php


    $name = $_GET['name'];
    $grape_id = $_GET['grape_id'];
    $year = $_GET['year'];
    $wine_type_id = $_GET['wine_type_id'];
    $country_id = $_GET['country_id'];
    $tasting_note = $_GET['tasting_note'];
    $price = $_GET['price'];

    $results_per_page = 10;
    $current_page = $_GET['page'];
    $first_page = 1;

    $sql = "SELECT * 
				FROM wine_list, grapes, wine_types, countries
				WHERE wine_list.grape_id = grapes.grape_id 
				    AND wine_list.wine_type_id = wine_types.wine_type_id
                    AND wine_list.country_id = countries.country_id
                    AND wine_list.name LIKE '%" . $name . "%'";

    if($year != '')  {
               $sql = $sql . " AND wine_list.year = " . $year;
    }

    if ($wine_type_id != 'all' && $country_id == 'all' && $grape_id == 'all') {
        $sql = $sql . " AND wine_types.wine_type_id = " . $wine_type_id;
    }
    else if ($wine_type_id == 'all' && $country_id != 'all' && $grape_id != 'all') {
        $sql = $sql . " AND countries.country_id = " . $country_id;
    }
    else if ($wine_type_id == 'all' && $country_id == 'all' && $grape_id != 'all') {
        $sql = $sql . " AND grapes.grape_id = " . $grape_id;
    }
    else if ($wine_type_id != 'all' && $country_id != 'all' && $grape_id == 'all'){
        $sql = $sql . " AND wine_types.wine_type_id = " . $wine_type_id . " AND countries.country_id = " . $country_id;
    }
    else if ($wine_type_id != 'all' && $country_id == 'all' && $grape_id != 'all'){
        $sql = $sql . " AND wine_types.wine_type_id = " . $wine_type_id . " AND grapes.grape_id = " . $grape_id;
    }
    else if ($wine_type_id != 'all' && $country_id != 'all' && $grape_id != 'all'){
        $sql = $sql . " AND wine_types.wine_type_id = " . $wine_type_id . " AND countries.country_id = " . $country_id . " AND grapes.grape_id = " . $grape_id;
    }


    $results = mysqli_query($conn, $sql);

    if (!$results) {
        exit("SQL Error: " . mysqli_error($conn));
    }

    $total_results = mysqli_num_rows($results);
    $last_page = ceil($total_results/$results_per_page);

    if(empty($current_page)) {
        $current_page = $first_page;
    } elseif ($current_page < $first_page) {
        $current_page = $first_page;
    } elseif ($current_page > $last_page) {
        $current_page = $last_page;
    }

    $start_index = ($current_page-1) * $results_per_page;

    $sql = $sql . " LIMIT $start_index, $results_per_page ";

    $results = mysqli_query($conn, $sql);

    if (!$results) {
        exit("2nd SQL Error: " . mysqli_error($conn));
    }

    // 3. Display results



    ?>

    <div id="table">


        <table >
            <tr>
                <th>Wine ID</th>
                <th>Wine Name</th>
                <th>Grape Type</th>
                <th>Year Bottled</th>
                <th>Wine Type</th>
                <th>Country</th>

            </tr>

            <?php

            while ( $row = mysqli_fetch_array($results) ) {
                echo "<tr>";
                echo "<td>" . $row['wine_id'] . "</td>";

                echo "<td><a href='wine_details.php?wine_id=" . $row['wine_id'] . "'>" . $row['name'] . "</a></td>";
                echo "<td>" . $row['grape'] .  "</td>";
                echo "<td>" . $row['year'] .  "</td>";
                echo "<td>" . $row['wine_type'] .  "</td>";
                echo "<td>" . $row['country'] .  "</td>";
                if($_SESSION['logged_in']) {

                    echo "<td><a href='wine_delete.php?wine_id=" . $row['wine_id'] . "'>DELETE</a></td>";
                }
                echo "</tr>";


            }
            ?>
        </table>


    <div id="page">
        <?php  echo "Showing $results_per_page of $total_results results.";?>
        <a href="wine_results.php?name=<?php echo $name; ?>&grape_id=<?php echo $grape_id; ?>&year=<?php echo $year; ?>&wine_type_id=<?php echo $wine_type_id; ?>&country_id=<?php echo $country_id; ?>&page=<?php echo $first_page; ?>">
            [<< First]
        </a>
        <a href="wine_results.php?title=<?php echo $name; ?>&grape_id=<?php echo $grape_id; ?>&year=<?php echo $year; ?>&wine_type_id=<?php echo $wine_type_id; ?>&country_id=<?php echo $country_id; ?>&page=<?php echo ($current_page-1); ?>">
            [< Previous]
        </a>

        <?php echo "$current_page of $last_page"; ?>

        <a href="wine_results.php?title=<?php echo $name; ?>&grape_id=<?php echo $grape_id; ?>&year=<?php echo $year; ?>&wine_type_id=<?php echo $wine_type_id; ?>&country_id=<?php echo $country_id; ?>&page=<?php echo ($current_page+1); ?>">
            [Next >]
        </a>
        <a href="wine_results.php?title=<?php echo $name; ?>&grape_id=<?php echo $grape_id; ?>&year=<?php echo $year; ?>&wine_type_id=<?php echo $wine_type_id; ?>&country_id=<?php echo $country_id; ?>&page=<?php echo $last_page; ?>">
            [Last >>]
        </a>
    </div>

    <div style="margin-bottom:100px;"></div>
    </div>
</div> <!--close outtercontainer-->

