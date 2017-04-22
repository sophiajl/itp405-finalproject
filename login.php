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

<div>

    <div id="box">
        <form method="post" action="profile.php">
            Username: <input type="text" name="username"/>
            <br/>
            Password: <input type="password" name="pass"/>
            <br/>
            <input type="submit" value="Login"/>
        </form>

    </div>
</div>


</div> <!--close outercontainer-->

</body>
</html>

