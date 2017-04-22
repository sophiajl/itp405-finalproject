
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
        float:left;
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



    <div style="position:relative;padding-left:30px;padding-right:30px;">
        <a href="home.php" id="name"> Vinosaurus </a>
        <div style="margin:auto;">
            <a href="" class="navlink">About Us</a>
            <a href="sign_up.php" class="navlink" style ="float:right;font-size:20px;margin-top:35px;margin-left:20px;width:80px;">Sign Up</a>
            <span style="color:white; font-size:15px;float:right;margin-top:40px;">or</span>
            <a href="login.php" class="navlink" style ="float:right;font-size:20px;margin-top:35px;width:100px;">Log-in</a>
            <br style="clear:both;">
        </div>
    </div>

    <img src="winerack.jpg" style="width:100%;opacity:0.8;">

    <div id="body">
        <div style="float:left;text-align:center;center;font-size:30px; color:white;font-weight:bold;">
            About Vinosaurus

            Vinosaurus attempts to create a wine community where users can search and create wine lists


            Vinosaurus changes the way people wine.

            Founded by a wine enthusiast!
            <hr>

            <hr>
        </div><!--close intro-->
    </div><!--close body-->
</div> <!--close outercontainer-->


</body>
</html>
