
if ($wine_type_id != 'all' && $country_id == 'all' && $grape_id == 'all' && $wine_type_id != '') {
$sql = $sql . " AND wine_types.wine_type_id = " . $wine_type_id;
}
else if ($wine_type_id == 'all' && $country_id != 'all' && $grape_id != 'all' && $country_id != '' && $grape_id != '') {
$sql = $sql . " AND countries.country_id = " . $country_id;
}
else if ($wine_type_id == 'all' && $country_id == 'all' && $grape_id != 'all' && $grape_id != '') {
$sql = $sql . " AND grapes.grape_id = " . $grape_id;
}
else if ($wine_type_id != 'all' && $country_id != 'all' && $grape_id == 'all' && $wine_type_id != '' && $country_id != ''){
$sql = $sql . " AND wine_types.wine_type_id = " . $wine_type_id . " AND countries.country_id = " . $country_id;
}
else if ($wine_type_id != 'all' && $country_id == 'all' && $grape_id != 'all' && $wine_type_id != '' && $grape_id != ''){
$sql = $sql . " AND wine_types.wine_type_id = " . $wine_type_id . " AND grapes.grape_id = " . $grape_id;
}
else if ($wine_type_id != 'all' && $country_id != 'all' && $grape_id != 'all' && $wine_type_id != '' && $country_id != '' && $grape_id != ''){
$sql = $sql . " AND wine_types.wine_type_id = " . $wine_type_id . " AND countries.country_id = " . $country_id . " AND grapes.grape_id = " . $grape_id;
}


AND wine_list.year = " . $year . "
AND wine_list.price = " . $price . "
AND wine_list.name LIKE '%" . $name . "%'
AND tasting_note LIKE '%" . $tasting_note . "%'";


if ($type_id != 'All' && $country_id == 'All' && $grape_id == 'All') {
$sql = $sql . " AND types.type_id = " . $type_id;
}
else if ($type_id == 'All' && $country_id != 'All' && $grape_id != 'All') {
$sql = $sql . " AND countries.country_id = " . $country_id;
}
else if ($type_id == 'All' && $country_id == 'All' && $grape_id != 'All') {
$sql = $sql . " AND grapes.grape_id = " . $grape_id;
}
else if ($type_id != 'All' && $country_id != 'All' && $grape_id == 'All'){
$sql = $sql . " AND types.type_id = " . $type_id . " AND countries.country_id = " . $country_id;
}
else if ($type_id != 'All' && $country_id == 'All' && $grape_id != 'All'){
$sql = $sql . " AND types.type_id = " . $type_id . " AND grapes.grape_id = " . $grape_id;
}
else if ($type_id == 'All' && $country_id != 'All' && $grape_id != 'All'){
$sql = $sql . " AND countries.country_id = " . $country_id . " AND grapes.grape_id = " . $grape_id;
}
else if ($type_id != 'All' && $country_id != 'All' && $grape_id != 'All'){
$sql = $sql . " AND types.type_id = " . $type_id . " AND countries.country_id = " . $country_id . " AND grapes.grape_id = " . $grape_id;
}


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
</style>


<body style="background-color:#FFFACC">

<div id="outercontainer">



    <div style="position:relative;padding-left:30px;padding-right:30px;">
        <a href="home.php" id="name"> Vinosaurus </a>
        <div style="margin:auto;">
            <a href="" class="navlink">About Us</a>
            <a href="" class="navlink">Wines</a>
            <a href="" class="navlink" >Top Lists</a>
            <a href="sign_up.php" class="navlink" style ="float:right;font-size:20px;margin-top:35px;margin-left:20px;width:80px;">Sign Up</a>
            <span style="color:white; font-size:15px;float:right;margin-top:40px;">or</span>
            <a href="login.php" class="navlink" style ="float:right;font-size:20px;margin-top:35px;width:100px;">Log-in</a>
            <br style="clear:both;">
        </div>
    </div>


    <?php


    $name = $_GET['name'];
    $grape_id = $_GET['grape_id'];
    $year = $_GET['year'];
    $type_id = $_GET['type_id'];
    $country_id = $_GET['country_id'];
    $tasting_note = $_GET['tasting_note'];
    $price = $_GET['price'];

    $results_per_page = 5;
    $current_page = $_GET['page'];
    $first_page = 1;


    // 1. Establish MySQL Connection
    $host = 'uscitp.com';
    $user = 'sophiajl_dvduser';
    $pass = 'dvduser';
    $db = 'sophiajl_wine_db';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        exit("MySQL Connection Error: " . mysqli_connect_error());
    }

    // 2. Generate & Submit SQL.

    $sql = "SELECT * 
				FROM wine_list, grapes, types, countries
				WHERE wine_list.grape_id = grapes.grape_id 
				    AND wine_list.type_id = types.type_id
                    AND wine_list.country_id = countries.country_id";

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

    $sql = $sql . "LIMIT $start_index, $results_per_page";

    $results = mysqli_query($conn, $sql);

    if (!$results) {
        exit("2 SQL Error: " . mysqli_error($conn));
    }
    // 3. Display results

    echo "Showing $results_per_page of $total_results results.";



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
                <th>Tasting Notes</th>
                <th>Price</th>
            </tr>

            <?php

            while ( $row = mysqli_fetch_array($results) ) {
                echo "<tr>";
                echo "<td>" . $row['wine_list_id'] . "</td>";

                echo "<td><a href='dvd_details.php?wine_list_id=" . $row['wine_list_id'] . "'>" . $row['name'] . "</a></td>";
                echo "<td>" . $row['grape'] .  "</td>";
                echo "<td>" . $row['year'] .  "</td>";
                echo "<td>" . $row['type'] .  "</td>";
                echo "<td>" . $row['country'] .  "</td>";
                echo "<td>" . $row['tasting_note'] .  "</td>";
                echo "<td>" . $row['price'] .  "</td>";

                echo "<td><a href='dvd_edit.php?dvd_title_id=" . $row['dvd_title_id'] . "'>EDIT </a></td>";
                echo "</tr>";


            }
            ?>
        </table>
    </div>
    <div>
        <a href="dvd_results.php?title=<?php echo $title; ?>&genre_id=<?php echo $genre_id; ?>&rating_id=<?php echo $rating_id; ?>&page=<?php echo $first_page; ?>">
            [<< First]
        </a>
        <a href="dvd_results.php?title=<?php echo $title; ?>&genre_id=<?php echo $genre_id; ?>&rating_id=<?php echo $rating_id; ?>&page=<?php echo ($current_page-1); ?>">
            [< Previous]
        </a>

        <?php echo "$current_page of $last_page"; ?>

        <a href="dvd_results.php?title=<?php echo $title; ?>&genre_id=<?php  echo $genre_id; ?>&rating_id=<?php echo $rating_id; ?>&page=<?php echo ($current_page+1); ?>">
            [Next >]
        </a>
        <a href="dvd_results.php?title=<?php echo $title; ?>&genre_id=<?php  echo $genre_id; ?>&rating_id=<?php echo $rating_id; ?>&page=<?php echo $last_page; ?>">
            [Last >>]
        </a>
    </div>

    <div style="margin-bottom:200px;"></div>
</div> <!--close outtercontainer-->




